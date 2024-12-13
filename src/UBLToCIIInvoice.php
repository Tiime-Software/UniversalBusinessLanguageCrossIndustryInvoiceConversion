<?php

namespace Tiime\UniversalBusinessLanguageCrossIndustryInvoiceConversion;

use Tiime\CrossIndustryInvoice\BasicWL\CrossIndustryInvoice as BasicWLCrossIndustryInvoice;
use Tiime\CrossIndustryInvoice\DataType\ActualDeliverySupplyChainEvent;
use Tiime\CrossIndustryInvoice\DataType\Basic\ApplicableTradeTax;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\ApplicableHeaderTradeAgreement;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\ApplicableHeaderTradeDelivery;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\ApplicableHeaderTradeSettlement;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\BuyerTradeParty;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\ExchangedDocument;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\HeaderApplicableTradeTax;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\PayeePartyCreditorFinancialAccount;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\PayeeSpecifiedLegalOrganization;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\PostalTradeAddress;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\SellerSpecifiedLegalOrganization;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\SellerTradeParty;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\SpecifiedTradeSettlementHeaderMonetarySummation;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\SpecifiedTradeSettlementPaymentMeans;
use Tiime\CrossIndustryInvoice\DataType\BasicWL\SupplyChainTradeTransaction;
use Tiime\CrossIndustryInvoice\DataType\BillingSpecifiedPeriod;
use Tiime\CrossIndustryInvoice\DataType\BusinessProcessSpecifiedDocumentContextParameter;
use Tiime\CrossIndustryInvoice\DataType\BuyerGlobalIdentifier;
use Tiime\CrossIndustryInvoice\DataType\BuyerOrderReferencedDocument;
use Tiime\CrossIndustryInvoice\DataType\CategoryTradeTax;
use Tiime\CrossIndustryInvoice\DataType\ContractReferencedDocument;
use Tiime\CrossIndustryInvoice\DataType\DefinedTradeContact;
use Tiime\CrossIndustryInvoice\DataType\DespatchAdviceReferencedDocument;
use Tiime\CrossIndustryInvoice\DataType\DocumentIncludedNote;
use Tiime\CrossIndustryInvoice\DataType\DueDateDateTime;
use Tiime\CrossIndustryInvoice\DataType\EmailURIUniversalCommunication;
use Tiime\CrossIndustryInvoice\DataType\EN16931\BuyerSpecifiedLegalOrganization;
use Tiime\CrossIndustryInvoice\DataType\EndDateTime;
use Tiime\CrossIndustryInvoice\DataType\ExchangedDocumentContext;
use Tiime\CrossIndustryInvoice\DataType\FormattedIssueDateTime;
use Tiime\CrossIndustryInvoice\DataType\GuidelineSpecifiedDocumentContextParameter;
use Tiime\CrossIndustryInvoice\DataType\InvoiceReferencedDocument;
use Tiime\CrossIndustryInvoice\DataType\IssueDateTime;
use Tiime\CrossIndustryInvoice\DataType\LocationGlobalIdentifier;
use Tiime\CrossIndustryInvoice\DataType\OccurrenceDateTime;
use Tiime\CrossIndustryInvoice\DataType\PayeeGlobalIdentifier;
use Tiime\CrossIndustryInvoice\DataType\PayeeTradeParty;
use Tiime\CrossIndustryInvoice\DataType\PayerPartyDebtorFinancialAccount;
use Tiime\CrossIndustryInvoice\DataType\ReceivableSpecifiedTradeAccountingAccount;
use Tiime\CrossIndustryInvoice\DataType\SellerGlobalIdentifier;
use Tiime\CrossIndustryInvoice\DataType\SellerTaxRepresentativeTradeParty;
use Tiime\CrossIndustryInvoice\DataType\ShipToTradeParty;
use Tiime\CrossIndustryInvoice\DataType\SpecifiedTaxRegistrationVA;
use Tiime\CrossIndustryInvoice\DataType\SpecifiedTradeAllowance;
use Tiime\CrossIndustryInvoice\DataType\SpecifiedTradeCharge;
use Tiime\CrossIndustryInvoice\DataType\SpecifiedTradePaymentTerms;
use Tiime\CrossIndustryInvoice\DataType\StartDateTime;
use Tiime\CrossIndustryInvoice\DataType\TaxTotalAmount;
use Tiime\CrossIndustryInvoice\DataType\TelephoneUniversalCommunication;
use Tiime\CrossIndustryInvoice\DataType\URIUniversalCommunication;
use Tiime\EN16931\Codelist\InvoiceTypeCodeUNTDID1001;
use Tiime\EN16931\Converter\TimeReferencingCodeUNTDID2005ToTimeReferencingCodeUNTDID2475;
use Tiime\EN16931\DataType\Identifier\BankAssignedCreditorIdentifier;
use Tiime\EN16931\DataType\Identifier\ElectronicAddressIdentifier;
use Tiime\EN16931\DataType\Identifier\SpecificationIdentifier;
use Tiime\EN16931\DataType\Reference\ContractReference;
use Tiime\EN16931\DataType\Reference\DespatchAdviceReference;
use Tiime\EN16931\DataType\Reference\PrecedingInvoiceReference;
use Tiime\UniversalBusinessLanguage\Ubl21\Invoice\DataType\Aggregate\Allowance;
use Tiime\UniversalBusinessLanguage\Ubl21\Invoice\DataType\Aggregate\PaymentMeans;
use Tiime\UniversalBusinessLanguage\Ubl21\Invoice\DataType\Aggregate\SellerPartyIdentification;
use Tiime\UniversalBusinessLanguage\Ubl21\Invoice\DataType\Aggregate\TaxSubtotal;
use Tiime\UniversalBusinessLanguage\Ubl21\Invoice\UniversalBusinessLanguage;

class UBLToCIIInvoice
{
    public static function convert(UniversalBusinessLanguage $invoice): BasicWLCrossIndustryInvoice
    {
        return new BasicWLCrossIndustryInvoice(
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
                identifier: new SpecificationIdentifier(SpecificationIdentifier::BASICWL)
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
            typeCode: InvoiceTypeCodeUNTDID1001::from($invoice->getInvoiceTypeCode()->value), // BT-3
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
            applicableHeaderTradeSettlement: self::getApplicableHeaderTradeSettlement($invoice) // BG-19.
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
            ->setContractReferencedDocument( // BT-12
                null === $invoice->getContractDocumentReference() ? null :
                new ContractReferencedDocument(
                    new ContractReference($invoice->getContractDocumentReference()->getIdentifier())
                )
            )
            ->setBuyerReference($invoice->getBuyerReference()) // BT-10
            ->setBuyerOrderReferencedDocument(// BT-14
                null === $invoice->getOrderReference() ? null :
                new BuyerOrderReferencedDocument(
                    $invoice->getOrderReference()->getIdentifier()
                )
            )
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
            /* TODO: BG-9 quand on implémentera CII EN16931
            ->setDefinedTradeContact( // BG-9
                null === $buyerParty->getContact() ? null
                    : (new DefinedTradeContact())
                        ->setPersonName($buyerParty->getContact()->getName()) // BT-56
                        ->setTelephoneUniversalCommunication(new TelephoneUniversalCommunication($buyerParty->getContact()->getTelephone())) // BT-57
                        ->setEmailURIUniversalCommunication(new EmailURIUniversalCommunication($buyerParty->getContact()->getElectronicMail())) // BT-58
            )
            */
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
            /* TODO: BG-6 quand on implémentera CII EN16931
            ->setDefinedTradeContact( // BG-6
                null === $sellerParty->getContact() ? null
                    : (new DefinedTradeContact())
                        ->setPersonName($sellerParty->getContact()->getName()) // BT-41
                        ->setTelephoneUniversalCommunication(new TelephoneUniversalCommunication($sellerParty->getContact()->getTelephone())) // BT-42
                        ->setEmailURIUniversalCommunication(new EmailURIUniversalCommunication($sellerParty->getContact()->getElectronicMail())) // BT-43
            )
            */
        ;
    }

    /**
     * BG-13-00.
     */
    private static function getApplicableHeaderTradeDelivery(UniversalBusinessLanguage $invoice): ApplicableHeaderTradeDelivery
    {
        return (new ApplicableHeaderTradeDelivery())
            ->setShipToTradeParty(self::getDelivery($invoice)) // BG-13
            ->setActualDeliverySupplyChainEvent( // BT-72-00
                null !== $invoice->getDelivery()?->getActualDeliveryDate()?->getDateTimeString() ?
                new ActualDeliverySupplyChainEvent(new OccurrenceDateTime($invoice->getDelivery()?->getActualDeliveryDate()?->getDateTimeString()))
                : null
            )
            ->setDespatchAdviceReferencedDocument( // BT-16-00
                null !== $invoice->getDespatchDocumentReference() ?
                new DespatchAdviceReferencedDocument(new DespatchAdviceReference($invoice->getDespatchDocumentReference()?->getIdentifier()))
                : null
            )
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
                    ->setDueDateDateTime(new DueDateDateTime($invoice->getDueDate()->getDateTimeString())) // BT-9-00
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
     * @return ApplicableTradeTax[]
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
                ),
            $invoice->getPaymentMeans())
        ;
    }
}
