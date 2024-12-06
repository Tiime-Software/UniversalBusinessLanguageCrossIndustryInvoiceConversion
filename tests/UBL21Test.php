<?php

declare(strict_types=1);

namespace Tiime\CrossIndustryInvoiceUniversalBusinessLanguageConversion\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Tiime\CrossIndustryInvoice\BasicWL\CrossIndustryInvoice;
use Tiime\UniversalBusinessLanguage\Ubl21\Invoice\UniversalBusinessLanguage;
use Tiime\UniversalBusinessLanguageCrossIndustryInvoiceConversion\UBLToCIIInvoice;

class UBL21Test extends TestCase
{
    #[TestDox('Create CII BasicWL Invoices from UBL 2.1')]
    #[DataProvider('provideUBL21Files')]
    public function testCreateCIIFromUBL21(string $filename): void
    {
        $document = new \DOMDocument();
        $content  = file_get_contents(__DIR__ . '/Fixtures/ubl21/' . $filename . '.xml');
        $document->loadXML($content);

        $invoice = UniversalBusinessLanguage::fromXML($document);
        $this->assertInstanceOf(UniversalBusinessLanguage::class, $invoice);

        $cii = UBLToCIIInvoice::convert($invoice);

        $this->assertInstanceOf(CrossIndustryInvoice::class, $cii);
    }

    public static function provideUBL21Files(): array
    {
        return [
            ['ubl21_fullcontent'],
        ];
    }
}
