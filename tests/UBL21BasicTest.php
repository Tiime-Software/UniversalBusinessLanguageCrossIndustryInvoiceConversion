<?php

declare(strict_types=1);

namespace Tiime\CrossIndustryInvoiceUniversalBusinessLanguageConversion\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Tiime\CrossIndustryInvoice\BasicWL\CrossIndustryInvoice;
use Tiime\UniversalBusinessLanguage\Ubl21\CreditNote\UniversalBusinessLanguage as CreditNoteUBL;
use Tiime\UniversalBusinessLanguage\Ubl21\Invoice\UniversalBusinessLanguage;
use Tiime\UniversalBusinessLanguageCrossIndustryInvoiceConversion\UBLToCIIBasicCreditNote;
use Tiime\UniversalBusinessLanguageCrossIndustryInvoiceConversion\UBLToCIIBasicInvoice;

class UBL21BasicTest extends TestCase
{
    #[TestDox('Create CII Basic Invoices from UBL 2.1')]
    #[DataProvider('provideUBL21FromBasicFiles')]
    public function testCreateCIIFromUBL21GeneratedByBasic(string $filename): void
    {
        $document = new \DOMDocument();
        $content  = file_get_contents(__DIR__ . '/Fixtures/UBL21/Basic/' . $filename . '.xml');
        $document->loadXML($content);

        $invoice = UniversalBusinessLanguage::fromXML($document);

        $this->assertInstanceOf(UniversalBusinessLanguage::class, $invoice);

        $cii = UBLToCIIBasicInvoice::convert($invoice);

        file_put_contents(__DIR__ . '/Fixtures/CII/Basic/' . $filename . '.xml', $cii->toXML()->saveXML());

        $this->assertInstanceOf(CrossIndustryInvoice::class, $cii);
    }

    public static function provideUBL21FromCreditNoteFiles(): array
    {
        return [
            ['UBL21CreditNote_V7_06'],
        ];
    }

    public static function provideUBL21FromBasicFiles(): array
    {
        return [
            ['CIIBasicInvoice'],
            ['CIIBasicInvoice_V7_01'],
            ['CIIBasicInvoice_V7_02'],
            ['CIIBasicInvoice_V7_03'],
            ['CIIBasicInvoice_V7_04'],
            ['CIIBasicInvoice_V7_05'],
            ['CIIBasicInvoice_V7_07'],
            ['CIIBasicInvoice_V7_08'],
            ['CIIBasicInvoice_V7_09'],
            ['CIIBasicInvoice_V7_10'],
            ['CIIBasicInvoice_V7_11'],
        ];
    }

    #[TestDox('Create CII BasicWL Credit Note from UBL 2.1')]
    #[DataProvider('provideUBL21FromBasicWLCreditNoteFiles')]
    public function testCreditNoteCreateCIIFromUBL21GeneratedByBasicWL(string $filename): void
    {
        $document = new \DOMDocument();
        $content  = file_get_contents(__DIR__ . '/Fixtures/UBL21/Basic/' . $filename . '.xml');
        $document->loadXML($content);

        $invoice = CreditNoteUBL::fromXML($document);

        $this->assertInstanceOf(CreditNoteUBL::class, $invoice);

        $cii = UBLToCIIBasicCreditNote::convert($invoice);

        file_put_contents(__DIR__ . '/Fixtures/CII/Basic/' . $filename . '.xml', $cii->toXML()->saveXML());

        $this->assertInstanceOf(CrossIndustryInvoice::class, $cii);
    }

    public static function provideUBL21FromBasicWLCreditNoteFiles(): array
    {
        return [
            ['UBL21CreditNote_V7_06'],
        ];
    }
}
