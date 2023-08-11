<?php

declare(strict_types=1);

namespace Hereldar\CharacterEncodings\Enums;

/**
 * @see https://en.wikipedia.org/wiki/Unicode_character_property#Script
 * @see https://www.unicode.org/reports/tr24/
 * @see https://github.com/unicode-org/icu4x/blob/main/components/properties/src/props.rs#L1308
 * @see https://doc.qt.io/qt-6/qchar.html#Script-enum
 */
enum Script: int
{
    use IntEnumValues;

    /** Characters that may be used with multiple scripts */
    case Common = 0;

    /** Characters that may be used with multiple scripts, and that inherit their script from a preceding base character */
    case Inherited = 1;

    /** Unassigned, private-use, non-character, and surrogate code points */
    case Unknown = 103;

    case Adlam = 167;
    //case Afaka = 147;
    case Ahom = 161;
    case AnatolianHieroglyphs = 156;
    case Arabic = 2;
    case Armenian = 3;
    case Avestan = 117;
    case Balinese = 62;
    case Bamum = 130;
    case BassaVah = 134;
    case Batak = 63;
    case Bengali = 4;
    case Bhaiksuki = 168;
    //case Blissymbols = 64;
    //case BookPahlavi = 124;
    case Bopomofo = 5;
    case Brahmi = 65;
    case Braille = 46;
    case Buginese = 55;
    case Buhid = 44;
    case CanadianAboriginal = 40;
    case Carian = 104;
    case CaucasianAlbanian = 159;
    case Chakma = 118;
    case Cham = 66;
    case Cherokee = 6;
    case Chorasmian = 189;
    //case Cirth = 67;
    case Coptic = 7;
    case Cuneiform = 101;
    case Cyprio = 47;
    case CyproMinoan = 193;
    case Cyrillic = 8;
    //case CyrillicClassical = 68;
    case Deseret = 9;
    case Devanagari = 10;
    case DivesAkuru = 190;
    case Dogra = 178;
    case Duployan = 135;
    //case EgyptianDemotic = 69;
    //case EgyptianHieratic = 70;
    case EgyptianHieroglyphs = 71;
    case Elbasan = 136;
    case Elymaic = 185;
    case Ethiopian = 11;
    case Georgian = 12;
    case Glagolitic = 56;
    case Gothic = 13;
    case Grantha = 137;
    case Greek = 14;
    case Gujarati = 15;
    case GunjalaGondi = 179;
    case Gurmukhi = 16;
    case Han = 17;
    //case HanSimplified = 73;
    //case HanTraditional = 74;
    //case HanWithBopomofo = 172;
    case Hangul = 18;
    case HanifiRohingya = 182;
    case Hanunoo = 43;
    case Hatran = 162;
    case Hebrew = 19;
    case Hiragana = 20;
    case ImperialAramaic = 116;
    //case Indus = 77;
    case InscriptionalPahlavi = 122;
    case InscriptionalParthian = 125;
    //case Jamo = 173;
    //case Japonese = 105;
    case Javanese = 78;
    //case Jurchen = 148;
    case Kaithi = 120;
    case Kannada = 21;
    case Katakana = 22;
    //case KatakanaOrHiragana = 54;
    case Kawi = 198;
    case KayahLi = 79;
    case Kharoshthi = 57;
    //case KhitanLargeScript = null;
    case KhitanSmallScript = 191;
    case Khmer = 23;
    case Khojki = 157;
    case Khudawadi = 145;
    //case Khutsuri = 72;
    //case Klingon = null;
    //case Korean = 119;
    //case Kpelle = 138;
    case Lao = 24;
    case Latin = 25;
    //case LatinFraktur = 80;
    //case LatinGaelic = 81;
    //case Leke = null;
    case Lepcha = 82;
    case Limbu = 48;
    case LinearA = 83;
    case LinearB = 49;
    case Lisu = 131;
    //case Loma = 139;
    case Lycian = 107;
    case Lydian = 108;
    case Mahajani = 160;
    case Makasar = 180;
    case Malayalam = 26;
    case Mandaic = 84;
    case Manichaean = 121;
    case Marchen = 169;
    case MasaramGondi = 175;
    //case MathematicalNotation = 128;
    //case MayanHieroglyphs = 85;
    case Medefaidrin = 181;
    case MeeteiMayek = 115;
    case MendeKikakui = 140;
    case MeroiticCursive = 141;
    case MeroiticHieroglyphs = 86;
    case Miao = 92;
    case Modi = 163;
    case Mongolian = 27;
    //case Moon = 114;
    case Mro = 149;
    case Multani = 164;
    case Myanmar = 28;
    case Nabataean = 143;
    case NagMundari = 199;
    //case NakhiGeba = 132;
    case Nandinagari = 187;
    //case NaxiDongba = null;
    case NewTaiLue = 59;
    case Newa = 170;
    case Nko = 87;
    case Nushu = 150;
    case NyiakengPuachueHmong = 186;
    case Ogham = 29;
    case OlChiki = 109;
    case OldHungarian = 76;
    case OldItalic = 30;
    case OldNorthArabian = 142;
    case OldPermic = 89;
    case OldPersian = 61;
    case OldSogdian = 184;
    case OldSouthArabian = 133;
    case OldTurkic = 88;
    case OldUyghur = 194;
    case Oriya = 31;
    case Osage = 171;
    case Osmanya = 50;
    case PahawhHmong = 75;
    case Palmyrene = 144;
    case PauCinHau = 165;
    case PhagsPa = 90;
    case Phoenician = 91;
    //case ProtoCuneiform = null;
    //case ProtoElamite = null;
    //case ProtoSinaitic = null;
    case PsalterPahlavi = 123;
    //case Ranjana = null;
    case Rejang = 110;
    //case Rongorongo = 93;
    case Runic = 32;
    case Samaritan = 126;
    //case Sarati = 94;
    case Saurashtra = 111;
    case Sharada = 151;
    case Shavian = 51;
    //case Shuishu = null;
    case Siddham = 166;
    case SignWriting = 112;
    case Sinhala = 33;
    case Sogdian = 183;
    case SoraSompeng = 152;
    case Soyombo = 176;
    case Sundanese = 113;
    case SylotiNagri = 58;
    //case Symbol = 129;
    //case SymbolEmoji = 174;
    case Syriac = 34;
    //case SyriacEastern = 97;
    //case SyriacEstrangelo = 95;
    //case SyriacWestern = 96;
    case Tagalog = 42;
    case Tagbanwa = 45;
    case TaiLe = 52;
    case TaiTham = 106;
    case TaiViet = 127;
    case Takri = 153;
    case Tamil = 35;
    case Tangsa = 195;
    case Tangut = 154;
    case Telugu = 36;
    //case Tengwar = 98;
    case Thaana = 37;
    case Thai = 38;
    case Tibetan = 39;
    case Tifinagh = 60;
    case Tirhuta = 158;
    case Toto = 196;
    case Ugaritic = 53;
    //case UnwrittenDocuments = 102;
    case Vai = 99;
    //case VisibleSpeech = 100;
    case Vithkuqi = 197;
    case Wancho = 188;
    case WarangCiti = 146;
    //case Woleai = 155;
    case Yezidi = 192;
    case Yi = 41;
    case ZanabazarSquare = 177;

    public function description(): string
    {
        return match ($this) {
            self::Common => 'Characters that may be used with multiple scripts',
            self::Inherited => 'Characters that may be used with multiple scripts, and that inherit their script from a preceding base character',
            self::Unknown => 'Unassigned, private-use, non-character, and surrogate code points',
            default => '',
        };
    }
}
