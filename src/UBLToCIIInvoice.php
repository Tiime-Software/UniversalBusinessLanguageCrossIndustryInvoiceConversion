<?php

namespace Tiime\UniversalBusinessLanguageCrossIndustryInvoiceConversion;

use Tiime\CrossIndustryInvoice\BasicWL\CrossIndustryInvoice as BasicWLCrossIndustryInvoice;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\ApplicableHeaderTradeAgreement;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\BuyerTradeParty;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\ExchangedDocument;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\PostalTradeAddress;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\SellerTradeParty;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\SupplyChainTradeTransaction;
use Tiime\CrossIndustryInvoice\DataType\ExchangedDocumentContext;
use Tiime\CrossIndustryInvoice\DataType\GuidelineSpecifiedDocumentContextParameter;
use Tiime\CrossIndustryInvoice\DataType\IssueDateTime;
use Tiime\EN16931\Codelist\InvoiceTypeCodeUNTDID1001;
use Tiime\EN16931\DataType\Identifier\SpecificationIdentifier;
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
        return new BuyerTradeParty(
            name: $invoice->getAccountingCustomerParty()->getParty()->getPartyName()->getName(),
            postalTradeAddress: (new PostalTradeAddress(countryID: $invoice->getAccountingCustomerParty()->getParty()->getPostalAddress()->getCountry()->getIdentificationCode()))
                ->setLineOne($invoice->getAccountingCustomerParty()->getParty()->getPostalAddress()->getStreetName()) // BT-50
                ->setLineTwo($invoice->getAccountingCustomerParty()->getParty()->getPostalAddress()->getAdditionalStreetName()) // BT-51
                ->setLineThree($invoice->getAccountingCustomerParty()->getParty()->getPostalAddress()->getAddressLine()?->getLine()) // BT-163
                ->setCityName($invoice->getAccountingCustomerParty()->getParty()->getPostalAddress()->getCityName()) // BT-52
                ->setPostcodeCode($invoice->getAccountingCustomerParty()->getParty()->getPostalAddress()->getPostalZone()) // BT-53
                ->setCountrySubDivisionName($invoice->getAccountingCustomerParty()->getParty()->getPostalAddress()->getCountrySubentity()) // BT-54
        );
        // @todo ajouter les setter du buyerTradeParty
    }

    private static function getSellerTradeParty(UniversalBusinessLanguage $invoice): SellerTradeParty
    {
        return new SellerTradeParty(
            name: $invoice->getAccountingSupplierParty()->getParty()->getPartyName()->getName(),
            postalTradeAddress: (new PostalTradeAddress(countryID: $invoice->getAccountingSupplierParty()->getParty()->getPostalAddress()->getCountry()->getIdentificationCode()))
                ->setLineOne($invoice->getAccountingSupplierParty()->getParty()->getPostalAddress()->getStreetName()) // BT-35
                ->setLineTwo($invoice->getAccountingSupplierParty()->getParty()->getPostalAddress()->getAdditionalStreetName()) // BT-36
                ->setLineThree($invoice->getAccountingSupplierParty()->getParty()->getPostalAddress()->getAddressLine()?->getLine()) // BT-162
                ->setCityName($invoice->getAccountingSupplierParty()->getParty()->getPostalAddress()->getCityName()) // BT-37
                ->setPostcodeCode($invoice->getAccountingSupplierParty()->getParty()->getPostalAddress()->getPostalZone()) // BT-38
                ->setCountrySubDivisionName($invoice->getAccountingSupplierParty()->getParty()->getPostalAddress()->getCountrySubentity()) // BT-39
        );
    }
}
