<?php

declare(strict_types=1);

namespace Tiime\CrossIndustryInvoiceUniversalBusinessLanguageConversion\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Tiime\CrossIndustryInvoice\BasicWL\CrossIndustryInvoice;
use Tiime\UniversalBusinessLanguage\Ubl21\CreditNote\UniversalBusinessLanguage as CreditNoteUBL;
use Tiime\UniversalBusinessLanguage\Ubl21\Invoice\UniversalBusinessLanguage;
use Tiime\UniversalBusinessLanguageCrossIndustryInvoiceConversion\UBLToCIICreditNote;
use Tiime\UniversalBusinessLanguageCrossIndustryInvoiceConversion\UBLToCIIInvoice;

class UBL21BasicWLTest extends TestCase
{
    #[TestDox('Create CII BasicWL Invoices from UBL 2.1')]
    #[DataProvider('provideUBL21FromBasicWLFiles')]
    public function testCreateCIIFromUBL21GeneratedByBasicWL(string $filename): void
    {
        $document = new \DOMDocument();
        $content  = file_get_contents(__DIR__ . '/Fixtures/UBL21/BasicWL/' . $filename . '.xml');
        $document->loadXML($content);

        $invoice = UniversalBusinessLanguage::fromXML($document);

        $this->assertInstanceOf(UniversalBusinessLanguage::class, $invoice);

        $cii = UBLToCIIInvoice::convert($invoice);

        file_put_contents(__DIR__ . '/Fixtures/CII/BasicWL/' . $filename . '.xml', $cii->toXML()->saveXML());

        $this->assertInstanceOf(CrossIndustryInvoice::class, $cii);
    }

    public static function provideUBL21FromBasicWLFiles(): array
    {
        return [
            ['CIIBasicWLInvoice'],
            ['CIIBasicWLInvoice_V7_01'],
            ['CIIBasicWLInvoice_V7_02'],
            ['CIIBasicWLInvoice_V7_03'],
            ['CIIBasicWLInvoice_V7_04'],
            ['CIIBasicWLInvoice_V7_05'],
            ['CIIBasicWLInvoice_V7_07'],
            ['CIIBasicWLInvoice_V7_08'],
            ['CIIBasicWLInvoice_V7_09'],
            ['CIIBasicWLInvoice_V7_10'],
            ['CIIBasicWLInvoice_V7_11'],
        ];
    }

    #[TestDox('Create CII BasicWL Credit Note from UBL 2.1')]
    #[DataProvider('provideUBL21FromBasicWLCreditNoteFiles')]
    public function testCreditNoteCreateCIIFromUBL21GeneratedByBasicWL(string $filename): void
    {
        $document = new \DOMDocument();
        $content  = file_get_contents(__DIR__ . '/Fixtures/UBL21/BasicWL/' . $filename . '.xml');
        $document->loadXML($content);

        $invoice = CreditNoteUBL::fromXML($document);

        $this->assertInstanceOf(CreditNoteUBL::class, $invoice);

        $cii = UBLToCIICreditNote::convert($invoice);

        file_put_contents(__DIR__ . '/Fixtures/CII/BasicWL/' . $filename . '.xml', $cii->toXML()->saveXML());

        $this->assertInstanceOf(CrossIndustryInvoice::class, $cii);
    }

    public static function provideUBL21FromBasicWLCreditNoteFiles(): array
    {
        return [
            ['UBL21CreditNote_V7_06'],
        ];
    }
}
