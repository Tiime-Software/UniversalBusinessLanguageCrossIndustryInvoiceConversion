<?php

namespace Tiime\UniversalBusinessLanguageCrossIndustryInvoiceConversion;

use Tiime\CrossIndustryInvoice\BasicWL\CrossIndustryInvoice as BasicWLCrossIndustryInvoice;
use Tiime\UniversalBusinessLanguage\Ubl21\CreditNote\UniversalBusinessLanguage;

class UBLToCIICreditNote
{
    public static function convert(UniversalBusinessLanguage $invoice): BasicWLCrossIndustryInvoice
    {
        return new BasicWLCrossIndustryInvoice(
        );
    }
}
