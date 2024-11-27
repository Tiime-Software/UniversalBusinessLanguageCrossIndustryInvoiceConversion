<?php

namespace Tiime\UniversalBusinessLanguageCrossIndustryInvoiceConversion;

use Tiime\CrossIndustryInvoice\BasicWL\CrossIndustryInvoice as BasicWLCrossIndustryInvoice;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\ApplicableHeaderTradeAgreement;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\BuyerTradeParty;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\ExchangedDocument;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\PostalTradeAddress;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\SellerSpecifiedLegalOrganization;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\SellerTradeParty;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\SupplyChainTradeTransaction;
use Tiime\CrossIndustryInvoice\DataType\BuyerGlobalIdentifier;
use Tiime\CrossIndustryInvoice\DataType\EN16931\BuyerSpecifiedLegalOrganization;
use Tiime\CrossIndustryInvoice\DataType\ExchangedDocumentContext;
use Tiime\CrossIndustryInvoice\DataType\GuidelineSpecifiedDocumentContextParameter;
use Tiime\CrossIndustryInvoice\DataType\IssueDateTime;
use Tiime\CrossIndustryInvoice\DataType\SellerGlobalIdentifier;
use Tiime\CrossIndustryInvoice\DataType\SpecifiedTaxRegistrationVA;
use Tiime\CrossIndustryInvoice\DataType\URIUniversalCommunication;
use Tiime\EN16931\Codelist\InvoiceTypeCodeUNTDID1001;
use Tiime\EN16931\DataType\Identifier\ElectronicAddressIdentifier;
use Tiime\EN16931\DataType\Identifier\SpecificationIdentifier;
use Tiime\EN16931\DataType\Identifier\VatIdentifier;
use Tiime\UniversalBusinessLanguage\Ubl21\Invoice\DataType\Aggregate\SellerPartyIdentification;
use Tiime\UniversalBusinessLanguage\Ubl21\Invoice\UniversalBusinessLanguage;

class UBLToCIIInvoice
{
    public static function convert(UniversalBusinessLanguage $invoice): BasicWLCrossIndustryInvoice
    {
        return new BasicWLCrossIndustryInvoice(
            exchangedDocumentContext: self::getExchangedDocumentContext(), // BG-2
            exchangedDocument: self::getExchangedDocument($invoice), // BT-1-00
            supplyChainTradeTransaction: self::getSupplyChainTradeTransaction($invoice) // BG-25-00
        );
    }

    private static function getExchangedDocumentContext(): ExchangedDocumentContext
    {
        return new ExchangedDocumentContext(
            guidelineSpecifiedDocumentContextParameter: new GuidelineSpecifiedDocumentContextParameter(
                identifier: new SpecificationIdentifier(SpecificationIdentifier::BASICWL)
            ) // BT-24-00
        );
    }

    private static function getExchangedDocument(UniversalBusinessLanguage $invoice): ExchangedDocument
    {
        return new ExchangedDocument(
            identifier: $invoice->getIdentifier(), // BT-1
            typeCode: InvoiceTypeCodeUNTDID1001::from($invoice->getInvoiceTypeCode()->value), // BT-3
            issueDateTime: new IssueDateTime($invoice->getIssueDate()->getDateTimeString()) // BT-2-00
        );
    }

    private static function getSupplyChainTradeTransaction(UniversalBusinessLanguage $invoice): SupplyChainTradeTransaction
    {
        return new SupplyChainTradeTransaction(
            applicableHeaderTradeAgreement: self::getApplicableHeaderTradeAgreement($invoice),
            applicableHeaderTradeDelivery: self::getApplicableHeaderTradeDelivery(),
            applicableHeaderTradeSettlement: self::getApplicableHeaderTradeSettlement()
        );
    }

    private static function getApplicableHeaderTradeAgreement(UniversalBusinessLanguage $invoice): ApplicableHeaderTradeAgreement
    {
        return new ApplicableHeaderTradeAgreement(
            sellerTradeParty: self::getSellerTradeParty($invoice),
            buyerTradeParty: self::getBuyerTradeParty($invoice) // BG-7
        );
    }

    private static function getBuyerTradeParty(UniversalBusinessLanguage $invoice): BuyerTradeParty
    {
        $buyerParty = $invoice->getAccountingCustomerParty()->getParty();

        return (new BuyerTradeParty(
            name: $buyerParty->getPartyName()->getName(),
            postalTradeAddress: (new PostalTradeAddress(countryID: $buyerParty->getPostalAddress()->getCountry()->getIdentificationCode()))
                ->setLineOne($buyerParty->getPostalAddress()->getStreetName()) // BT-50
                ->setLineTwo($buyerParty->getPostalAddress()->getAdditionalStreetName()) // BT-51
                ->setLineThree($buyerParty->getPostalAddress()->getAddressLine()?->getLine()) // BT-163
                ->setCityName($buyerParty->getPostalAddress()->getCityName()) // BT-52
                ->setPostcodeCode($buyerParty->getPostalAddress()->getPostalZone()) // BT-53
                ->setCountrySubDivisionName($buyerParty->getPostalAddress()->getCountrySubentity()) // BT-54
        ))
            ->setIdentifier(
                null === $buyerParty->getPartyIdentification()?->getBuyerIdentifier()->scheme ?
                $buyerParty->getPartyIdentification()?->getBuyerIdentifier()
                : null
            ) // BT-46
            ->setGlobalIdentifier(
                $buyerParty->getPartyIdentification()?->getBuyerIdentifier()->scheme ?
                new BuyerGlobalIdentifier(
                    $buyerParty->getPartyIdentification()?->getBuyerIdentifier()->value,
                    $buyerParty->getPartyIdentification()?->getBuyerIdentifier()->scheme
                ) : null
            ) // BT-46-0 & BT-46-1
            ->setURIUniversalCommunication(
                new URIUniversalCommunication(
                    new ElectronicAddressIdentifier(
                        $buyerParty->getEndpointIdentifier()?->value,
                        $buyerParty->getEndpointIdentifier()?->scheme
                    )
                )
            ) // BT-49
            ->setSpecifiedTaxRegistrationVA(
                new SpecifiedTaxRegistrationVA(
                    new VatIdentifier($buyerParty->getPartyTaxScheme()->getTaxScheme()->getIdentifier())
                )
            ) // BT-48
            ->setSpecifiedLegalOrganization(
                (new BuyerSpecifiedLegalOrganization())
                    ->setIdentifier($buyerParty->getPartyLegalEntity()->getIdentifier())
                    ->setTradingBusinessName($buyerParty->getPartyLegalEntity()->getRegistrationName())
            ) // BT-47
        ;
    }

    private static function getSellerTradeParty(UniversalBusinessLanguage $invoice): SellerTradeParty
    {
        $sellerParty = $invoice->getAccountingSupplierParty()->getParty();

        return (new SellerTradeParty(
            name: $sellerParty->getPartyName()->getName(),
            postalTradeAddress: (new PostalTradeAddress(countryID: $sellerParty->getPostalAddress()->getCountry()->getIdentificationCode()))
                ->setLineOne($sellerParty->getPostalAddress()->getStreetName()) // BT-35
                ->setLineTwo($sellerParty->getPostalAddress()->getAdditionalStreetName()) // BT-36
                ->setLineThree($sellerParty->getPostalAddress()->getAddressLine()?->getLine()) // BT-162
                ->setCityName($sellerParty->getPostalAddress()->getCityName()) // BT-37
                ->setPostcodeCode($sellerParty->getPostalAddress()->getPostalZone()) // BT-38
                ->setCountrySubDivisionName($sellerParty->getPostalAddress()->getCountrySubentity()) // BT-39
        ))
            ->setIdentifiers(
                array_map(
                    static fn (SellerPartyIdentification $partyIdentification) => null === $partyIdentification->getSellerIdentifier()->scheme ?
                    $partyIdentification->getSellerIdentifier()
                    : null,
                    $sellerParty->getPartyIdentifications()
                )
            ) // BT-90 + BT-29
            ->setGlobalIdentifiers(
                array_map(
                    static fn (SellerPartyIdentification $partyIdentification) => isset($partyIdentification->getSellerIdentifier()->scheme) ? new SellerGlobalIdentifier(
                        $partyIdentification->getSellerIdentifier()->value,
                        $partyIdentification->getSellerIdentifier()->scheme
                    ) : null,
                    $sellerParty->getPartyIdentifications()
                )
            )
            ->setURIUniversalCommunication(
                new URIUniversalCommunication(
                    new ElectronicAddressIdentifier(
                        $sellerParty->getEndpointIdentifier()?->value,
                        $sellerParty->getEndpointIdentifier()?->scheme
                    )
                )
            ) // BT-34
            ->setSpecifiedTaxRegistrationVA(
                empty($vatTaxScheme = array_filter(
                    $sellerParty->getPartyTaxSchemes(),
                    fn ($scheme) => 'VAT' === $scheme->getTaxScheme()->getIdentifier()
                )) ? null :
                new SpecifiedTaxRegistrationVA(
                    reset($vatTaxScheme)->getCompanyIdentifier()
                )
            ) // BT-31
            ->setSpecifiedLegalOrganization(
                (new SellerSpecifiedLegalOrganization())
                    ->setIdentifier($sellerParty->getPartyLegalEntity()->getIdentifier())
                    ->setTradingBusinessName($sellerParty->getPartyLegalEntity()->getRegistrationName())
            ) // BT-30
        ;
    }
}
