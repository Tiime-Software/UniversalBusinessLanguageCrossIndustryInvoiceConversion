<?php

namespace Tiime\UniversalBusinessLanguageCrossIndustryInvoiceConversion;

use Tiime\CrossIndustryInvoice\DataType\ActualDeliverySupplyChainEvent;
use Tiime\CrossIndustryInvoice\DataType\AdditionalReferencedDocumentAdditionalSupportingDocument;
use Tiime\CrossIndustryInvoice\DataType\AdditionalReferencedDocumentInvoicedObjectIdentifier;
use Tiime\CrossIndustryInvoice\DataType\AdditionalReferencedDocumentInvoiceLineObjectIdentifier;
use Tiime\CrossIndustryInvoice\DataType\AdditionalReferencedDocumentTenderOrLotReference;
use Tiime\CrossIndustryInvoice\DataType\ApplicableProductCharacteristic;
use Tiime\CrossIndustryInvoice\DataType\ApplicableTradeSettlementFinancialCard;
use Tiime\CrossIndustryInvoice\DataType\AssociatedDocumentLineDocument;
use Tiime\CrossIndustryInvoice\DataType\Basic\ApplicableTradeTax;
use Tiime\CrossIndustryInvoice\DataType\Basic\AppliedTradeAllowanceCharge;
use Tiime\CrossIndustryInvoice\DataType\Basic\BasisQuantity;
use Tiime\CrossIndustryInvoice\DataType\Basic\BilledQuantity;
use Tiime\CrossIndustryInvoice\DataType\Basic\GrossPriceProductTradePrice;
use Tiime\CrossIndustryInvoice\DataType\Basic\SpecifiedLineTradeDelivery;
use Tiime\CrossIndustryInvoice\DataType\Basic\SpecifiedTradeSettlementLineMonetarySummation;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\ExchangedDocument;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\PayeeSpecifiedLegalOrganization;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\PostalTradeAddress;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\SellerSpecifiedLegalOrganization;
use Tiime\CrossIndustryInvoice\DataType\BillingSpecifiedPeriod;
use Tiime\CrossIndustryInvoice\DataType\BusinessProcessSpecifiedDocumentContextParameter;
use Tiime\CrossIndustryInvoice\DataType\BuyerGlobalIdentifier;
use Tiime\CrossIndustryInvoice\DataType\BuyerOrderReferencedDocument;
use Tiime\CrossIndustryInvoice\DataType\CategoryTradeTax;
use Tiime\CrossIndustryInvoice\DataType\ClassCode;
use Tiime\CrossIndustryInvoice\DataType\ContractReferencedDocument;
use Tiime\CrossIndustryInvoice\DataType\DefinedTradeContact;
use Tiime\CrossIndustryInvoice\DataType\DesignatedProductClassification;
use Tiime\CrossIndustryInvoice\DataType\DespatchAdviceReferencedDocument;
use Tiime\CrossIndustryInvoice\DataType\DocumentIncludedNote;
use Tiime\CrossIndustryInvoice\DataType\DueDateDateTime;
use Tiime\CrossIndustryInvoice\DataType\EmailURIUniversalCommunication;
use Tiime\CrossIndustryInvoice\DataType\EN16931\ApplicableHeaderTradeAgreement;
use Tiime\CrossIndustryInvoice\DataType\EN16931\ApplicableHeaderTradeDelivery;
use Tiime\CrossIndustryInvoice\DataType\EN16931\ApplicableHeaderTradeSettlement;
use Tiime\CrossIndustryInvoice\DataType\EN16931\BuyerSpecifiedLegalOrganization;
use Tiime\CrossIndustryInvoice\DataType\EN16931\BuyerTradeParty;
use Tiime\CrossIndustryInvoice\DataType\EN16931\HeaderApplicableTradeTax;
use Tiime\CrossIndustryInvoice\DataType\EN16931\IncludedSupplyChainTradeLineItem;
use Tiime\CrossIndustryInvoice\DataType\EN16931\LineSpecifiedTradeAllowance;
use Tiime\CrossIndustryInvoice\DataType\EN16931\LineSpecifiedTradeCharge;
use Tiime\CrossIndustryInvoice\DataType\EN16931\PayeePartyCreditorFinancialAccount;
use Tiime\CrossIndustryInvoice\DataType\EN16931\SellerTradeParty;
use Tiime\CrossIndustryInvoice\DataType\EN16931\SpecifiedLineTradeAgreement;
use Tiime\CrossIndustryInvoice\DataType\EN16931\SpecifiedLineTradeSettlement;
use Tiime\CrossIndustryInvoice\DataType\EN16931\SpecifiedTradeProduct;
use Tiime\CrossIndustryInvoice\DataType\EN16931\SpecifiedTradeSettlementHeaderMonetarySummation;
use Tiime\CrossIndustryInvoice\DataType\EN16931\SpecifiedTradeSettlementPaymentMeans;
use Tiime\CrossIndustryInvoice\DataType\EN16931\SupplyChainTradeTransaction;
use Tiime\CrossIndustryInvoice\DataType\EndDateTime;
use Tiime\CrossIndustryInvoice\DataType\ExchangedDocumentContext;
use Tiime\CrossIndustryInvoice\DataType\FormattedIssueDateTime;
use Tiime\CrossIndustryInvoice\DataType\GuidelineSpecifiedDocumentContextParameter;
use Tiime\CrossIndustryInvoice\DataType\InvoiceReferencedDocument;
use Tiime\CrossIndustryInvoice\DataType\IssueDateTime;
use Tiime\CrossIndustryInvoice\DataType\LineBuyerOrderReferencedDocument;
use Tiime\CrossIndustryInvoice\DataType\LineIncludedNote;
use Tiime\CrossIndustryInvoice\DataType\LocationGlobalIdentifier;
use Tiime\CrossIndustryInvoice\DataType\NetPriceProductTradePrice;
use Tiime\CrossIndustryInvoice\DataType\OccurrenceDateTime;
use Tiime\CrossIndustryInvoice\DataType\OriginTradeCountry;
use Tiime\CrossIndustryInvoice\DataType\PayeeGlobalIdentifier;
use Tiime\CrossIndustryInvoice\DataType\PayeeSpecifiedCreditorFinancialInstitution;
use Tiime\CrossIndustryInvoice\DataType\PayeeTradeParty;
use Tiime\CrossIndustryInvoice\DataType\PayerPartyDebtorFinancialAccount;
use Tiime\CrossIndustryInvoice\DataType\ReceivableSpecifiedTradeAccountingAccount;
use Tiime\CrossIndustryInvoice\DataType\ReceivingAdviceReferencedDocument;
use Tiime\CrossIndustryInvoice\DataType\SellerGlobalIdentifier;
use Tiime\CrossIndustryInvoice\DataType\SellerOrderReferencedDocument;
use Tiime\CrossIndustryInvoice\DataType\SellerTaxRepresentativeTradeParty;
use Tiime\CrossIndustryInvoice\DataType\ShipToTradeParty;
use Tiime\CrossIndustryInvoice\DataType\SpecifiedProcuringProject;
use Tiime\CrossIndustryInvoice\DataType\SpecifiedTaxRegistrationVA;
use Tiime\CrossIndustryInvoice\DataType\SpecifiedTradeAllowance;
use Tiime\CrossIndustryInvoice\DataType\SpecifiedTradeCharge;
use Tiime\CrossIndustryInvoice\DataType\SpecifiedTradePaymentTerms;
use Tiime\CrossIndustryInvoice\DataType\StartDateTime;
use Tiime\CrossIndustryInvoice\DataType\TaxTotalAmount;
use Tiime\CrossIndustryInvoice\DataType\TelephoneUniversalCommunication;
use Tiime\CrossIndustryInvoice\DataType\URIUniversalCommunication;
use Tiime\CrossIndustryInvoice\EN16931\CrossIndustryInvoice;
use Tiime\EN16931\Codelist\InvoiceTypeCodeUNTDID1001;
use Tiime\EN16931\Converter\TimeReferencingCodeUNTDID2005ToTimeReferencingCodeUNTDID2475;
use Tiime\EN16931\DataType\Identifier\BankAssignedCreditorIdentifier;
use Tiime\EN16931\DataType\Identifier\BuyerItemIdentifier;
use Tiime\EN16931\DataType\Identifier\ElectronicAddressIdentifier;
use Tiime\EN16931\DataType\Identifier\ObjectIdentifier;
use Tiime\EN16931\DataType\Identifier\SellerItemIdentifier;
use Tiime\EN16931\DataType\Identifier\SpecificationIdentifier;
use Tiime\EN16931\DataType\Identifier\StandardItemIdentifier;
use Tiime\EN16931\DataType\Reference\ContractReference;
use Tiime\EN16931\DataType\Reference\DespatchAdviceReference;
use Tiime\EN16931\DataType\Reference\PrecedingInvoiceReference;
use Tiime\EN16931\DataType\Reference\ProjectReference;
use Tiime\EN16931\DataType\Reference\ReceivingAdviceReference;
use Tiime\EN16931\DataType\Reference\SupportingDocumentReference;
use Tiime\EN16931\DataType\Reference\TenderOrLotReference;
use Tiime\UniversalBusinessLanguage\Ubl21\CreditNote\DataType\Aggregate\AdditionalDocumentReference;
use Tiime\UniversalBusinessLanguage\Ubl21\CreditNote\DataType\Aggregate\AdditionalItemProperty;
use Tiime\UniversalBusinessLanguage\Ubl21\CreditNote\DataType\Aggregate\Allowance;
use Tiime\UniversalBusinessLanguage\Ubl21\CreditNote\DataType\Aggregate\CommodityClassification;
use Tiime\UniversalBusinessLanguage\Ubl21\CreditNote\DataType\Aggregate\CreditNoteLine;
use Tiime\UniversalBusinessLanguage\Ubl21\CreditNote\DataType\Aggregate\InvoiceLineAllowance;
use Tiime\UniversalBusinessLanguage\Ubl21\CreditNote\DataType\Aggregate\InvoiceLineCharge;
use Tiime\UniversalBusinessLanguage\Ubl21\CreditNote\DataType\Aggregate\PaymentMeans;
use Tiime\UniversalBusinessLanguage\Ubl21\CreditNote\DataType\Aggregate\SellerPartyIdentification;
use Tiime\UniversalBusinessLanguage\Ubl21\CreditNote\DataType\Aggregate\TaxSubtotal;
use Tiime\UniversalBusinessLanguage\Ubl21\CreditNote\UniversalBusinessLanguage;

class UBLToCIIEN16931CreditNote
{
    public static function convert(UniversalBusinessLanguage $invoice): CrossIndustryInvoice
    {
        return new CrossIndustryInvoice(
            exchangedDocumentContext: self::getExchangedDocumentContext($invoice), // BG-2
            exchangedDocument: self::getExchangedDocument($invoice), // BT-1-00
            supplyChainTradeTransaction: self::getSupplyChainTradeTransaction($invoice) // BG-25-00
        );
    }

    /**
     * BG-2.
     */
    private static function getExchangedDocumentContext(UniversalBusinessLanguage $invoice): ExchangedDocumentContext
    {
        return (new ExchangedDocumentContext(
            guidelineSpecifiedDocumentContextParameter: new GuidelineSpecifiedDocumentContextParameter( // BT-24-00
                identifier: new SpecificationIdentifier(SpecificationIdentifier::EN16931)
            )
        ))
            ->setBusinessProcessSpecifiedDocumentContextParameter( // BT-23-00
                null === $invoice->getProfileIdentifier() ? null :
                new BusinessProcessSpecifiedDocumentContextParameter(
                    $invoice->getProfileIdentifier()
                )
            )
        ;
    }

    /**
     * BT-1-00.
     */
    private static function getExchangedDocument(UniversalBusinessLanguage $invoice): ExchangedDocument
    {
        return (new ExchangedDocument(
            identifier: $invoice->getIdentifier(), // BT-1
            typeCode: InvoiceTypeCodeUNTDID1001::from($invoice->getCreditNoteTypeCode()->value), // BT-3
            issueDateTime: new IssueDateTime($invoice->getIssueDate()->getDateTimeString()) // BT-2-00
        ))
            ->setIncludedNotes( // BG-1
                array_map(
                    static fn ($note) => (new DocumentIncludedNote(
                        content: $note->getContent() // BT-22
                    ))->setSubjectCode($note->getSubjectCode()), // BT-21
                    $invoice->getNotes()
                )
            )
        ;
    }

    /**
     * BG-25-00.
     */
    private static function getSupplyChainTradeTransaction(UniversalBusinessLanguage $invoice): SupplyChainTradeTransaction
    {
        return new SupplyChainTradeTransaction(
            applicableHeaderTradeAgreement: self::getApplicableHeaderTradeAgreement($invoice), // BT-10.
            applicableHeaderTradeDelivery: self::getApplicableHeaderTradeDelivery($invoice), // BG-13.
            applicableHeaderTradeSettlement: self::getApplicableHeaderTradeSettlement($invoice), // BG-19.
            includedSupplyChainTradeLineItems: self::getIncludedSupplyChainTradeLineItems($invoice), // BG-25.
        );
    }

    /**
     * BT-10.
     */
    private static function getApplicableHeaderTradeAgreement(UniversalBusinessLanguage $invoice): ApplicableHeaderTradeAgreement
    {
        return (new ApplicableHeaderTradeAgreement(
            sellerTradeParty: self::getSellerTradeParty($invoice), // BG-4
            buyerTradeParty: self::getBuyerTradeParty($invoice) // BG-7
        ))
            ->setSellerTaxRepresentativeTradeParty( // BG-11
                null === $invoice->getTaxRepresentativeParty() ? null :
                new SellerTaxRepresentativeTradeParty(
                    $invoice->getTaxRepresentativeParty()?->getPartyName()->getName(), // BT-62
                    (new PostalTradeAddress( // BG-12
                        $invoice->getTaxRepresentativeParty()->getPostalAddress()->getCountry()->getIdentificationCode()) // BT-69
                    )
                        ->setLineOne($invoice->getTaxRepresentativeParty()->getPostalAddress()->getStreetName()) // BT-64
                        ->setLineTwo($invoice->getTaxRepresentativeParty()->getPostalAddress()->getAdditionalStreetName()) // BT-65
                        ->setLineThree($invoice->getTaxRepresentativeParty()->getPostalAddress()->getAddressLine()?->getLine()) // BT-164
                        ->setCityName($invoice->getTaxRepresentativeParty()->getPostalAddress()->getCityName()) // BT-66
                        ->setPostcodeCode($invoice->getTaxRepresentativeParty()->getPostalAddress()->getPostalZone()) // BT-67
                        ->setCountrySubDivisionName($invoice->getTaxRepresentativeParty()->getPostalAddress()->getCountrySubentity()), // BT-68
                    new SpecifiedTaxRegistrationVA($invoice->getTaxRepresentativeParty()->getPartyTaxScheme()->getCompanyIdentifier()) // BT-63-00
                ))
            ->setSpecifiedProcuringProject(self::getSpecifiedProcuringProject($invoice)) // BT-11
            ->setContractReferencedDocument( // BT-12
                null === $invoice->getContractDocumentReference() ? null :
                new ContractReferencedDocument(
                    new ContractReference($invoice->getContractDocumentReference()->getIdentifier())
                )
            )
            ->setBuyerReference($invoice->getBuyerReference()) // BT-10
            ->setBuyerOrderReferencedDocument(
                null === $invoice->getOrderReference() ? null :
                new BuyerOrderReferencedDocument(
                    $invoice->getOrderReference()->getIdentifier()
                )
            ) // BT-13
            ->setSellerOrderReferencedDocument(
                null === $invoice->getOrderReference()?->getSalesOrderIdentifier() ? null :
                    new SellerOrderReferencedDocument($invoice->getOrderReference()->getSalesOrderIdentifier())
            ) // BT-14
            ->setAdditionalReferencedDocuments(
                array_map(
                    static fn (AdditionalDocumentReference $additionalDocumentReference) => (new AdditionalReferencedDocumentAdditionalSupportingDocument(
                        new SupportingDocumentReference($additionalDocumentReference->getIdentifier()->value) // BT-128
                    ))
                        ->setName($additionalDocumentReference->getDocumentDescription()) // BT-123
                        ->setUriIdentifier($additionalDocumentReference->getAttachment()?->getExternalReference()->getUri()) // BT-124
                        ->setAttachmentBinaryObject(
                            $additionalDocumentReference->getAttachment()?->getEmbeddedDocumentBinaryObject()
                        ) // BT-125
                    ,
                    array_filter($invoice->getAdditionalDocumentReferences(), fn (AdditionalDocumentReference $additionalDocumentReference) => null === $additionalDocumentReference->getIdentifier()->scheme)
                )
            ) // BG-24
            ->setAdditionalReferencedDocumentInvoicedObjectIdentifier(
                self::getAdditionalReferencedDocumentInvoicedObjectIdentifier($invoice)
            ) // BT-18-00
            ->setAdditionalReferencedDocumentTenderOrLotReference(
                null === $invoice->getOriginatorDocumentReference() ? null :
                new AdditionalReferencedDocumentTenderOrLotReference(
                    new TenderOrLotReference($invoice->getOriginatorDocumentReference()->getIdentifier())
                )
            ) // BT-17-00
        ;
    }

    /**
     * BG-7.
     */
    private static function getBuyerTradeParty(UniversalBusinessLanguage $invoice): BuyerTradeParty
    {
        $buyerParty = $invoice->getAccountingCustomerParty()->getParty();

        return (new BuyerTradeParty( // BG-7
            name: $buyerParty->getPartyLegalEntity()?->getRegistrationName(), // BT-44
            postalTradeAddress: (new PostalTradeAddress(countryID: $buyerParty->getPostalAddress()->getCountry()->getIdentificationCode()))
                ->setLineOne($buyerParty->getPostalAddress()->getStreetName()) // BT-50
                ->setLineTwo($buyerParty->getPostalAddress()->getAdditionalStreetName()) // BT-51
                ->setLineThree($buyerParty->getPostalAddress()->getAddressLine()?->getLine()) // BT-163
                ->setCityName($buyerParty->getPostalAddress()->getCityName()) // BT-52
                ->setPostcodeCode($buyerParty->getPostalAddress()->getPostalZone()) // BT-53
                ->setCountrySubDivisionName($buyerParty->getPostalAddress()->getCountrySubentity()) // BT-54
        ))
            ->setIdentifier( // BT-46
                null === $buyerParty->getPartyIdentification()?->getBuyerIdentifier()->scheme ?
                $buyerParty->getPartyIdentification()?->getBuyerIdentifier()
                : null
            )
            ->setGlobalIdentifier( // BT-46-0 & BT-46-1
                $buyerParty->getPartyIdentification()?->getBuyerIdentifier()->scheme ?
                new BuyerGlobalIdentifier(
                    $buyerParty->getPartyIdentification()?->getBuyerIdentifier()->value,
                    $buyerParty->getPartyIdentification()?->getBuyerIdentifier()->scheme
                ) : null
            )
            ->setSpecifiedLegalOrganization( // BT-47
                (new BuyerSpecifiedLegalOrganization())
                    ->setIdentifier($buyerParty->getPartyLegalEntity()->getIdentifier())
                    ->setTradingBusinessName($buyerParty->getPartyName()?->getName()) // BT-45
            )
            ->setSpecifiedTaxRegistrationVA( // BT-48
                null === $buyerParty->getPartyTaxScheme() ? null :
                new SpecifiedTaxRegistrationVA(
                    $buyerParty->getPartyTaxScheme()->getCompanyIdentifier()
                )
            )
            ->setURIUniversalCommunication( // BT-49
                null === $buyerParty->getEndpointIdentifier() ? null :
                new URIUniversalCommunication(
                    new ElectronicAddressIdentifier(
                        $buyerParty->getEndpointIdentifier()->value,
                        $buyerParty->getEndpointIdentifier()->scheme
                    )
                )
            )
            ->setDefinedTradeContact( // BG-9
                null === $buyerParty->getContact() ? null
                    : (new DefinedTradeContact())
                        ->setPersonName($buyerParty->getContact()->getName()) // BT-56
                        ->setTelephoneUniversalCommunication(new TelephoneUniversalCommunication($buyerParty->getContact()->getTelephone())) // BT-57
                        ->setEmailURIUniversalCommunication(new EmailURIUniversalCommunication($buyerParty->getContact()->getElectronicMail())) // BT-58
                        ->setDepartmentName('') // BT-56-00 TODO not in UBL ?
            )
        ;
    }

    /**
     * BG-4.
     */
    private static function getSellerTradeParty(UniversalBusinessLanguage $invoice): SellerTradeParty
    {
        $sellerParty = $invoice->getAccountingSupplierParty()->getParty();

        return (new SellerTradeParty( // BG-4
            name: $sellerParty->getPartyLegalEntity()?->getRegistrationName(), // BT-27
            postalTradeAddress: (new PostalTradeAddress(countryID: $sellerParty->getPostalAddress()->getCountry()->getIdentificationCode()))
                ->setLineOne($sellerParty->getPostalAddress()->getStreetName()) // BT-35
                ->setLineTwo($sellerParty->getPostalAddress()->getAdditionalStreetName()) // BT-36
                ->setLineThree($sellerParty->getPostalAddress()->getAddressLine()?->getLine()) // BT-162
                ->setCityName($sellerParty->getPostalAddress()->getCityName()) // BT-37
                ->setPostcodeCode($sellerParty->getPostalAddress()->getPostalZone()) // BT-38
                ->setCountrySubDivisionName($sellerParty->getPostalAddress()->getCountrySubentity()) // BT-39
        ))
            ->setIdentifiers( // BT-90 + BT-29
                array_map(
                    static fn (SellerPartyIdentification $partyIdentification) => $partyIdentification->getSellerIdentifier(),
                    array_filter($sellerParty->getPartyIdentifications(), fn (SellerPartyIdentification $sellerPartyIdentification) => null === $sellerPartyIdentification->getSellerIdentifier()->scheme)
                )
            )
            ->setGlobalIdentifiers( // BT-90 + BT-29
                array_map(
                    static fn (SellerPartyIdentification $partyIdentification) => new SellerGlobalIdentifier(
                        $partyIdentification->getSellerIdentifier()->value,
                        $partyIdentification->getSellerIdentifier()->scheme
                    ),
                    array_filter($sellerParty->getPartyIdentifications(), fn (SellerPartyIdentification $sellerPartyIdentification) => null !== $sellerPartyIdentification->getSellerIdentifier()->scheme)
                )
            )
            ->setSpecifiedLegalOrganization( // BT-30
                specifiedLegalOrganization: (new SellerSpecifiedLegalOrganization())
                    ->setIdentifier($sellerParty->getPartyLegalEntity()?->getIdentifier())
                    ->setTradingBusinessName($sellerParty->getPartyName()?->getName()) // BT-28
            )
            ->setSpecifiedTaxRegistrationVA( // BT-31
                empty($vatTaxScheme = array_filter(
                    $sellerParty->getPartyTaxSchemes(),
                    fn ($scheme) => 'VAT' === $scheme->getTaxScheme()->getIdentifier()
                )) ? null :
                    new SpecifiedTaxRegistrationVA(
                        reset($vatTaxScheme)->getCompanyIdentifier()
                    )
            )
            ->setURIUniversalCommunication( // BT-34
                null === $sellerParty->getEndpointIdentifier() ? null :
                new URIUniversalCommunication(
                    new ElectronicAddressIdentifier(
                        $sellerParty->getEndpointIdentifier()->value,
                        $sellerParty->getEndpointIdentifier()->scheme
                    )
                )
            )
            ->setDefinedTradeContact( // BG-6
                null === $sellerParty->getContact() ? null
                    : (new DefinedTradeContact())
                        ->setPersonName($sellerParty->getContact()->getName()) // BT-41
                        ->setTelephoneUniversalCommunication(new TelephoneUniversalCommunication($sellerParty->getContact()->getTelephone())) // BT-42
                        ->setEmailURIUniversalCommunication(new EmailURIUniversalCommunication($sellerParty->getContact()->getElectronicMail())) // BT-43
            )
        ;
    }

    /**
     * BG-13-00.
     */
    private static function getApplicableHeaderTradeDelivery(UniversalBusinessLanguage $invoice): ApplicableHeaderTradeDelivery
    {
        return (new ApplicableHeaderTradeDelivery())
            ->setShipToTradeParty(self::getDelivery($invoice)) // BG-13
            ->setActualDeliverySupplyChainEvent(
                null !== $invoice->getDelivery()?->getActualDeliveryDate()?->getDateTimeString() ?
                new ActualDeliverySupplyChainEvent(new OccurrenceDateTime($invoice->getDelivery()?->getActualDeliveryDate()?->getDateTimeString()))
                : null
            ) // BT-72-00
            ->setDespatchAdviceReferencedDocument(
                null !== $invoice->getDespatchDocumentReference() ?
                new DespatchAdviceReferencedDocument(new DespatchAdviceReference($invoice->getDespatchDocumentReference()->getIdentifier()))
                : null
            ) // BT-16-00
            ->setReceivingAdviceReferencedDocument(
                null === $invoice->getReceiptDocumentReference() ? null :
                new ReceivingAdviceReferencedDocument(new ReceivingAdviceReference($invoice->getReceiptDocumentReference()->getIdentifier()))
            ) // BT-15-00
        ;
    }

    /**
     * BG-13.
     */
    private static function getDelivery(UniversalBusinessLanguage $invoice): ?ShipToTradeParty
    {
        $delivery = $invoice->getDelivery();

        if (null === $delivery) {
            return null;
        }

        return (new ShipToTradeParty())
            ->setIdentifier( // BT-71
                null === $delivery->getDeliveryLocation()?->getIdentifier()?->scheme ?
                $delivery->getDeliveryLocation()?->getIdentifier() : null
            )
            ->setGlobalIdentifier( // BT-71-0 & BT-71-1
                null !== $delivery->getDeliveryLocation()?->getIdentifier()?->scheme ?
                    new LocationGlobalIdentifier(
                        $delivery->getDeliveryLocation()?->getIdentifier()?->value,
                        $delivery->getDeliveryLocation()?->getIdentifier()?->scheme
                    ) : null
            )
            ->setName($delivery->getDeliveryParty()?->getPartyName()->getName()) // BT-70
            ->setPostalTradeAddress( // BG-15
                null === $delivery->getDeliveryLocation()?->getAddress() ? null :
                (new PostalTradeAddress($delivery->getDeliveryLocation()->getAddress()->getCountry()->getIdentificationCode()))
                    ->setLineOne($delivery->getDeliveryLocation()->getAddress()->getStreetName()) // BT-75
                    ->setLineTwo($delivery->getDeliveryLocation()->getAddress()->getAdditionalStreetName()) // BT-76
                    ->setLineThree($delivery->getDeliveryLocation()->getAddress()->getAddressLine()?->getLine()) // BT-163
                    ->setCityName($delivery->getDeliveryLocation()->getAddress()->getCityName()) // BT-77
                    ->setPostcodeCode($delivery->getDeliveryLocation()->getAddress()->getPostalZone()) // BT-78
                    ->setCountrySubDivisionName($delivery->getDeliveryLocation()->getAddress()->getCountrySubentity()) // BT-79
            )
        ;
    }

    /**
     * BG-19.
     */
    private static function getApplicableHeaderTradeSettlement(UniversalBusinessLanguage $invoice): ApplicableHeaderTradeSettlement
    {
        return (new ApplicableHeaderTradeSettlement( // BG-19
            invoiceCurrencyCode: $invoice->getDocumentCurrencyCode(),
            specifiedTradeSettlementHeaderMonetarySummation: self::getSpecifiedTradeSettlementHeaderMonetarySummation($invoice), // BG-22
            applicableTradeTaxes: self::getApplicableTradeTaxes($invoice), // BG-23
        ))
            ->setBillingSpecifiedPeriod( // BG-14
                null === $invoice->getInvoicePeriod() ? null :
                (new BillingSpecifiedPeriod())
                    ->setStartDateTime( // BT-73-00
                        null === $invoice->getInvoicePeriod()->getStartDate() ? null :
                        new StartDateTime($invoice->getInvoicePeriod()->getStartDate()->getDateTimeString())
                    )
                    ->setEndDateTime( // BT-74-00
                        null === $invoice->getInvoicePeriod()->getEndDate() ? null :
                        new EndDateTime($invoice->getInvoicePeriod()->getEndDate()->getDateTimeString())
                    )
            )
            ->setInvoiceReferencedDocuments(
                array_map(
                    static fn ($invoiceReference) => (new InvoiceReferencedDocument(
                        new PrecedingInvoiceReference($invoiceReference->getInvoiceDocumentReference()->getIssuerAssignedIdentifier()->value)
                    ))
                        ->setFormattedIssueDateTime(
                            null === $invoiceReference->getInvoiceDocumentReference()->getIssueDate() ? null :
                            new FormattedIssueDateTime($invoiceReference->getInvoiceDocumentReference()->getIssueDate()->getDateTimeString())
                        ),
                    $invoice->getBillingReferences()
                )
            ) // BG-3
            ->setPayeeTradeParty(self::getPayeeTradeParty($invoice)) // BG-10
            ->setSpecifiedTradePaymentTerms( // BT-20-00
                (new SpecifiedTradePaymentTerms())
                    ->setDescription($invoice->getPaymentTerms()?->getNote()) // BT-20
                    ->setDueDateDateTime( // BT-9-00
                        null === $invoice->getDueDate() ? null :
                        new DueDateDateTime($invoice->getDueDate()->getDateTimeString())
                    )
                    ->setDirectDebitMandateIdentifier( // BT-89
                        null === $invoice->getPaymentMeans()[0]?->getPaymentMandate() ? null :
                        $invoice->getPaymentMeans()[0]->getPaymentMandate()->getIdentifier()
                    )
            )
            ->setPaymentReference(
                \count($invoice->getPaymentMeans()) > 0 ? $invoice->getPaymentMeans()[0]->getPaymentIdentifier() : null
            ) // BT-83, TODO : à implémenter en fonction des cardinalités à clarifier
            ->setCreditorReferenceIdentifier( // BT-90
                null === $invoice->getPayeeParty()?->getPartyBankAssignedCreditorIdentification()?->getBankAssignedCreditorIdentifier() ? null :
                new BankAssignedCreditorIdentifier($invoice->getPayeeParty()->getPartyBankAssignedCreditorIdentification()->getBankAssignedCreditorIdentifier())
            )
            ->setReceivableSpecifiedTradeAccountingAccount(
                null === $invoice->getAccountingCost() ? null :
                new ReceivableSpecifiedTradeAccountingAccount($invoice->getAccountingCost())
            ) // BT-19-00
            ->setSpecifiedTradeAllowances(self::getSpecifiedTradeAllowances($invoice)) // BG-20
            ->setSpecifiedTradeCharges(self::getSpecifiedTradeCharges($invoice)) // BG-21
            ->setSpecifiedTradeSettlementPaymentMeans(self::getSpecifiedTradeSettlementPaymentMeans($invoice)) // BG-16
            ->setTaxCurrencyCode($invoice->getTaxCurrencyCode()) // BT-6
        ;
    }

    /**
     * BG-22.
     */
    private static function getSpecifiedTradeSettlementHeaderMonetarySummation(UniversalBusinessLanguage $invoice): SpecifiedTradeSettlementHeaderMonetarySummation
    {
        return (new SpecifiedTradeSettlementHeaderMonetarySummation(
            taxBasisTotalAmount: $invoice->getLegalMonetaryTotal()->getTaxExclusiveAmount()->getValue()->getValue(), // BT-109
            grandTotalAmount: $invoice->getLegalMonetaryTotal()->getTaxInclusiveAmount()->getValue()->getValue(), // BT-112
            duePayableAmount: $invoice->getLegalMonetaryTotal()->getPayableAmount()->getValue()->getValue(), // BT-115
            lineTotalAmount: $invoice->getLegalMonetaryTotal()->getLineExtensionAmount()->getValue()->getValue(), // BT-106
        ))
            ->setChargeTotalAmount($invoice->getLegalMonetaryTotal()->getChargeTotalAmount()?->getValue()->getValue()) // BT-108
            ->setAllowanceTotalAmount($invoice->getLegalMonetaryTotal()->getAllowanceTotalAmount()?->getValue()->getValue()) // BT-107
            ->setTaxTotalAmount( // BT-110 & BT-111
                new TaxTotalAmount(
                    \is_array($taxTotals = $invoice->getTaxTotals()) ? reset($taxTotals)->getTaxAmount()->getValue()->getValue() : 0,
                    reset($taxTotals)->getTaxAmount()->getCurrencyCode()
                )
            )
            ->setTotalPrepaidAmount($invoice->getLegalMonetaryTotal()->getPrepaidAmount()?->getValue()->getValue()) // BT-113
        ;
    }

    /**
     * BG-23.
     *
     * @return HeaderApplicableTradeTax[]
     */
    private static function getApplicableTradeTaxes(UniversalBusinessLanguage $invoice): array
    {
        $applicableTradeTaxes = [];

        foreach ($invoice->getTaxTotals() as $taxTotal) {
            if ([] === $taxTotal->getTaxSubtotals()) {
                continue;
            }

            $applicableTradeTaxes = array_map(
                static fn (TaxSubtotal $taxSubtotal) => (new HeaderApplicableTradeTax(
                    calculatedAmount: $taxSubtotal->getTaxAmount()->getValue()->getValue(), // BT-117
                    basisAmount: $taxSubtotal->getTaxableAmount()->getValue()->getValue(), // BT-116
                    categoryCode: $taxSubtotal->getTaxCategory()->getVatCategory() // BT-118
                ))
                    ->setDueDateTypeCode(TimeReferencingCodeUNTDID2005ToTimeReferencingCodeUNTDID2475::convertToUNTDID2475($invoice->getInvoicePeriod()?->getDescriptionCode())) // BT-8
                    ->setExemptionReason($taxSubtotal->getTaxCategory()->getTaxExemptionReason()) // BT-120
                    ->setExemptionReasonCode($taxSubtotal->getTaxCategory()->getTaxExemptionReasonCode()) // BT-121
                    ->setRateApplicablePercent( // BT-119
                        $taxSubtotal->getTaxCategory()->getPercent()?->getValue()
                    ),
                $taxTotal->getTaxSubtotals()
            );
        }

        return $applicableTradeTaxes;
    }

    /**
     * BG-10.
     */
    private static function getPayeeTradeParty(UniversalBusinessLanguage $invoice): ?PayeeTradeParty
    {
        $buyerIdentifier = $invoice->getPayeeParty()?->getPartyIdentification()?->getBuyerIdentifier();

        return null === $invoice->getPayeeParty() ? null :
            (new PayeeTradeParty($invoice->getPayeeParty()->getPartyName()->getName()))
                ->setIdentifier( // BT-60
                    null === $buyerIdentifier->scheme ? $buyerIdentifier : null
                )
                ->setGlobalIdentifier( // BT-60-0 & BT-60-1
                    null !== $buyerIdentifier->scheme ? new PayeeGlobalIdentifier(
                        $buyerIdentifier->value,
                        $buyerIdentifier->scheme
                    ) : null
                )
                ->setSpecifiedLegalOrganization( // BT-61-00
                    null === $invoice->getPayeeParty()->getPartyLegalEntity() ? null :
                        (new PayeeSpecifiedLegalOrganization())
                            ->setIdentifier($invoice->getPayeeParty()->getPartyLegalEntity()->getIdentifier())
                );
    }

    /**
     * BG-20.
     *
     * @return SpecifiedTradeAllowance[]
     */
    private static function getSpecifiedTradeAllowances(UniversalBusinessLanguage $invoice): array
    {
        return array_map(
            static fn (Allowance $allowance) => (new SpecifiedTradeAllowance(
                actualAmount: $allowance->getAmount()->getValue()->getValue(), // BT-92
                allowanceCategoryTradeTax: (new CategoryTradeTax( // BT-95-00
                    $allowance->getTaxCategory()->getVatCategory()) // BT-95
                )
                    ->setRateApplicablePercent($allowance->getTaxCategory()->getPercent()) // BT-96
            ))
                ->setBasisAmount($allowance->getBaseAmount()?->getValue()->getValue()) // BT-93
                ->setCalculationPercent($allowance->getMultiplierFactorNumeric()?->getValue()) // BT-94
                ->setReason($allowance->getAllowanceReason()) // BT-97
                ->setReasonCode($allowance->getAllowanceReasonCode()), // BT-98
            $invoice->getAllowances()
        );
    }

    /**
     * BG-21.
     *
     * @return SpecifiedTradeCharge[]
     */
    private static function getSpecifiedTradeCharges(UniversalBusinessLanguage $invoice): array
    {
        return array_map(
            static fn ($charge) => (new SpecifiedTradeCharge(
                actualAmount: $charge->getAmount()->getValue()->getValue(), // BT-99
                categoryTradeTax: (new CategoryTradeTax( // BT-102-00
                    $charge->getTaxCategory()->getVatCategory() // BT-102
                ))
                    ->setRateApplicablePercent($charge->getTaxCategory()->getPercent()) // BT-103
                ,
            ))
                ->setCalculationPercent($charge->getMultiplierFactorNumeric()?->getValue()) // BT-101
                ->setBasisAmount($charge->getBaseAmount()?->getValue()->getValue()) // BT-100
                ->setReasonCode($charge->getChargeReasonCode()) // BT-105
                ->setReason($charge->getChargeReason()), // BT-104
            $invoice->getCharges()
        );
    }

    /**
     * BG-16.
     *
     * @return SpecifiedTradeSettlementPaymentMeans[]
     */
    private static function getSpecifiedTradeSettlementPaymentMeans(UniversalBusinessLanguage $invoice): array
    {
        return array_map(
            static fn (PaymentMeans $paymentMeans) => (new SpecifiedTradeSettlementPaymentMeans(
                typeCode: $paymentMeans->getPaymentMeansCode()->getPaymentMeansCode() // BT-81
            ))
                ->setPayerPartyDebtorFinancialAccount( // BT-91-00
                    payerPartyDebtorFinancialAccount: null === $paymentMeans->getPaymentMandate()?->getPayerFinancialAccount()?->getIdentifier() ? null :
                    new PayerPartyDebtorFinancialAccount($paymentMeans->getPaymentMandate()->getPayerFinancialAccount()->getIdentifier()) // BT-91
                )
                ->setPayeePartyCreditorFinancialAccount( // BG-17
                    payeePartyCreditorFinancialAccount: null === $paymentMeans->getPayeeFinancialAccount()?->getPaymentAccountIdentifier() ? null :
                    (new PayeePartyCreditorFinancialAccount())
                        ->setProprietaryIdentifier($paymentMeans->getPayeeFinancialAccount()?->getPaymentAccountIdentifier())
                        ->setIbanIdentifier($paymentMeans->getPayeeFinancialAccount()?->getPaymentAccountIdentifier()) // BT-84
                )
                ->setInformation($paymentMeans->getPaymentMeansCode()->getName()) // BT-82
                ->setApplicableTradeSettlementFinancialCard(
                    null === $paymentMeans->getCardAccount() ? null :
                    (
                        new ApplicableTradeSettlementFinancialCard(
                            $paymentMeans->getCardAccount()->getPrimaryAccountNumberIdentifier()) // BT-87
                    )
                        ->setCardholderName($paymentMeans->getCardAccount()->getHolderName()) // BT-88
                ) // BG-18
                ->setPayeeSpecifiedCreditorFinancialInstitution( // BT-86-00
                    payeeSpecifiedCreditorFinancialInstitution: null === $paymentMeans->getPayeeFinancialAccount()?->getFinancialInstitutionBranch() ? null :
                    new PayeeSpecifiedCreditorFinancialInstitution($paymentMeans->getPayeeFinancialAccount()->getFinancialInstitutionBranch()->getIdentifier())
                ),
            $invoice->getPaymentMeans()
        )
        ;
    }

    /**
     * BG-25.
     *
     * @return IncludedSupplyChainTradeLineItem[]
     */
    private static function getIncludedSupplyChainTradeLineItems(UniversalBusinessLanguage $invoice): array
    {
        return array_map(
            static fn (CreditNoteLine $line) => new IncludedSupplyChainTradeLineItem(
                associatedDocumentLineDocument: (new AssociatedDocumentLineDocument($line->getInvoiceLineIdentifier()))
                    ->setIncludedNote(null === $line->getNote() ? null : new LineIncludedNote($line->getNote())), // BT-127-00.
                specifiedTradeProduct: self::getSpecifiedTradeProduct($line), // BG-31
                specifiedLineTradeAgreement: self::getSpecifiedLineTradeAgreement($line), // BG-29.
                specifiedLineTradeDelivery: new SpecifiedLineTradeDelivery(
                    new BilledQuantity(
                        quantity: $line->getCreditedQuantity()->getQuantity()->getValue(), // BT-129
                        unitCode: $line->getCreditedQuantity()->getUnitCode() // BT-130
                    )
                ), // BT-129-00.
                specifiedLineTradeSettlement: self::getSpecifiedLineTradeSettlement($line), // BG-30-00.
            ),
            $invoice->getCreditNoteLines()
        );
    }

    /**
     * BG-31.
     */
    private static function getSpecifiedTradeProduct(CreditNoteLine $line): SpecifiedTradeProduct
    {
        return (new SpecifiedTradeProduct(
            name: $line->getItem()->getName(), // BT-153
        ))
            ->setDescription($line->getItem()->getDescription()) // BT-154
            ->setSellerAssignedIdentifier(
                null === $line->getItem()->getSellersItemIdentification() ? null
                : new SellerItemIdentifier($line->getItem()->getSellersItemIdentification()->getSellersItemIdentifier())
            ) // BT-155
            ->setBuyerAssignedIdentifier(
                null === $line->getItem()->getBuyersItemIdentification() ? null
                : new BuyerItemIdentifier($line->getItem()->getBuyersItemIdentification()->getBuyersItemIdentifier())
            ) // BT-156
            ->setGlobalIdentifier(
                null === $line->getItem()->getStandardItemIdentification() ? null :
                    new StandardItemIdentifier(
                        value: $line->getItem()->getStandardItemIdentification()->getStandardItemIdentifier()->value,
                        scheme: $line->getItem()->getStandardItemIdentification()->getStandardItemIdentifier()->scheme
                    )
            ) // BT-157
            ->setApplicableProductCharacteristics(
                array_map(
                    static fn (AdditionalItemProperty $characteristic) => new ApplicableProductCharacteristic(
                        description: $characteristic->getValue(), // BT-160
                        value: $characteristic->getName() // BT-161
                    ),
                    $line->getItem()->getAdditionalProperties()
                )
            ) // BG-32
            ->setDesignatedProductClassifications(
                array_map(
                    static fn (CommodityClassification $classification) => (new DesignatedProductClassification())
                        ->setClassCode(
                            new ClassCode(
                                value: $classification->getItemClassificationCode(),
                                listIdentifier: $classification->getListIdentifier()
                            )
                        ),
                    $line->getItem()->getCommodityClassifications()
                )
            ) // BG-158-00.
            ->setOriginTradeCountry(
                null === $line->getItem()->getOriginCountry() ? null :
                    new OriginTradeCountry($line->getItem()->getOriginCountry()->getIdentificationCode())
            ) // BT-159-00
        ;
    }

    /**
     * BG-29.
     */
    private static function getSpecifiedLineTradeAgreement(CreditNoteLine $line): SpecifiedLineTradeAgreement
    {
        return (new SpecifiedLineTradeAgreement(
            netPriceProductTradePrice: (new NetPriceProductTradePrice(
                chargeAmount: $line->getPrice()->getPriceAmount()->getValue()->getValue(), // BT-146.
            )) // BT-146-00.
                ->setBasisQuantity(
                    basisQuantity: null === $line->getPrice()->getBaseQuantity() ? null :
                    (new BasisQuantity(
                        value: $line->getPrice()->getBaseQuantity()->getQuantity()->getValue(), // BT-149.
                    ))
                        ->setUnitCode($line->getPrice()->getBaseQuantity()->getUnitCode()) // BT-150.
                )
        ))
            ->setGrossPriceProductTradePrice(
                grossPriceProductTradePrice: null === $line->getPrice()->getAllowance() ? null :
                (new GrossPriceProductTradePrice(
                    chargeAmount: $line->getPrice()->getAllowance()->getBaseAmount()->getValue()->getValue(), // BT-147.
                )) // BT-148-00
                    ->setBasisQuantity(
                        basisQuantity: null === $line->getPrice()->getBaseQuantity() ? null :
                        (new BasisQuantity(
                            value: $line->getPrice()->getBaseQuantity()->getQuantity()->getValue(), // BT-149-1.
                        ))
                            ->setUnitCode($line->getPrice()->getBaseQuantity()->getUnitCode()) // BT-150-1.
                    )
                    ->setAppliedTradeAllowanceCharge(
                        appliedTradeAllowanceCharge: null === $line->getPrice()->getAllowance() ? null :
                        (new AppliedTradeAllowanceCharge(
                            actualAmount: $line->getPrice()->getAllowance()->getAmount()->getValue()->getValue(), // BT-147.
                        ))
                    )
            )
            ->setBuyerOrderReferencedDocument(
                null === $line->getOrderLineReference() ? null :
                    (new LineBuyerOrderReferencedDocument())
                        ->setLineIdentifier($line->getOrderLineReference()->getIdentifier()) // BT-132
            ) // BT-132-00.
        ;
    }

    /**
     * BG-30-00.
     */
    private static function getSpecifiedLineTradeSettlement(CreditNoteLine $line): SpecifiedLineTradeSettlement
    {
        return (new SpecifiedLineTradeSettlement(
            applicableTradeTax: (new ApplicableTradeTax($line->getItem()->getClassifiedTaxCategory()->getVatCategory()))
                ->setRateApplicablePercent($line->getItem()->getClassifiedTaxCategory()->getPercent()?->getValue()), // BG-30
            specifiedTradeSettlementLineMonetarySummation: (new SpecifiedTradeSettlementLineMonetarySummation($line->getLineExtensionAmount()->getValue()->getValue())), // BG-131-00.
        ))
            ->setBillingSpecifiedPeriod(
                null === $line->getInvoicePeriod() ? null :
                (new BillingSpecifiedPeriod())
                    ->setStartDateTime(
                        null === $line->getInvoicePeriod()->getStartDate() ? null :
                        new StartDateTime($line->getInvoicePeriod()->getStartDate()->getDateTimeString())
                    ) // BT-134
                    ->setEndDateTime(
                        null === $line->getInvoicePeriod()->getEndDate() ? null :
                        new EndDateTime($line->getInvoicePeriod()->getEndDate()->getDateTimeString())
                    ) // BT-135
            ) // BG-26
            ->setSpecifiedTradeAllowances(
                array_map(
                    static fn (InvoiceLineAllowance $allowance) => (new LineSpecifiedTradeAllowance(
                        actualAmount: $allowance->getAmount()->getValue()->getValue(), // BT-136
                    ))
                        ->setBasisAmount($allowance->getBaseAmount()?->getValue()->getValue()) // BT-137
                        ->setCalculationPercent($allowance->getMultiplierFactorNumeric()?->getValue()) // BT-138
                        ->setReason($allowance->getAllowanceReason()) // BT-139
                        ->setReasonCode($allowance->getAllowanceReasonCode()), // BT-140
                    $line->getAllowances()
                )
            ) // BG-27
            ->setSpecifiedTradeCharges(
                array_map(
                    static fn (InvoiceLineCharge $charge) => (new LineSpecifiedTradeCharge(
                        actualAmount: $charge->getAmount()->getValue()->getValue(), // BT-141
                    ))
                        ->setBasisAmount($charge->getBaseAmount()?->getValue()->getValue()) // BT-142
                        ->setCalculationPercent($charge->getMultiplierFactorNumeric()?->getValue()) // BT-143
                        ->setReason($charge->getChargeReason()) // BT-144
                        ->setReasonCode($charge->getChargeReasonCode()) // BT-145
                    , $line->getCharges()
                )
            ) // BG-28
            ->setReceivableSpecifiedTradeAccountingAccount(
                null === $line->getAccountingCost() ? null :
                new ReceivableSpecifiedTradeAccountingAccount($line->getAccountingCost())
            ) // BT-133-00
            ->setAdditionalReferencedDocument(
                null === $line->getDocumentReference() ? null :
                (new AdditionalReferencedDocumentInvoiceLineObjectIdentifier($line->getDocumentReference()->getIdentifier()))
            ) // BT-128-00
        ;
    }

    /**
     * BT-18-00.
     */
    private static function getAdditionalReferencedDocumentInvoicedObjectIdentifier(UniversalBusinessLanguage $invoice): ?AdditionalReferencedDocumentInvoicedObjectIdentifier
    {
        $filteredReferences = array_filter(
            $invoice->getAdditionalDocumentReferences(),
            fn (AdditionalDocumentReference $additionalDocumentReference) => null !== $additionalDocumentReference->getIdentifier()->scheme
        );
        $additionalDocumentReference = reset($filteredReferences);

        if (!$additionalDocumentReference) {
            return null;
        }

        return (new AdditionalReferencedDocumentInvoicedObjectIdentifier(
            new ObjectIdentifier($additionalDocumentReference->getIdentifier()->value)
        ))
            ->setReferenceTypeCode($additionalDocumentReference->getIdentifier()->scheme); // BT-18-1
    }

    /**
     * BT-11.
     */
    private static function getSpecifiedProcuringProject(UniversalBusinessLanguage $invoice): ?SpecifiedProcuringProject
    {
        if (null === $invoice->getAdditionalDocumentReferences()) {
            return null;
        }

        $projectReference = array_filter(
            $invoice->getAdditionalDocumentReferences(),
            fn (AdditionalDocumentReference $additionalDocumentReference) => '50' === $additionalDocumentReference->getDocumentTypeCode()
        );

        if (!$projectReference) {
            return null;
        }

        $projectReference = reset($projectReference);

        return new SpecifiedProcuringProject(
            new ProjectReference($projectReference->getIdentifier()->value)
        );
    }
}
