<?php

namespace Tiime\UniversalBusinessLanguageCrossIndustryInvoiceConversion;

use Tiime\CrossIndustryInvoice\BasicWL\CrossIndustryInvoice as BasicWLCrossIndustryInvoice;
use Tiime\EN16931\Helper\InvoiceTypeCodeUNTDID1001Helper;
use Tiime\UniversalBusinessLanguage\UniversalBusinessLanguageInterface;

class UniversalBusinessLanguageToCrossIndustryInvoice
{
    public static function convert(UniversalBusinessLanguageInterface $invoice): BasicWLCrossIndustryInvoice
    {
        if (InvoiceTypeCodeUNTDID1001Helper::isInvoice($invoice->getInvoiceTypeCode())) {
            return UBLToCIIInvoice::convert($invoice);
        }

        return UBLToCIICreditNote::convert($invoice);
    }
}
