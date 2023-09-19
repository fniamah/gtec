<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 5/13/2023
 * Time: 6:46 PM
 */
define("curDate",date("Y-m-d"));
define("DB_HOST",'localhost');
define("DB_USER",'root');
define("DB_PASSWORD",'');
define("DB_NAME",'fptec');
define("TIMESTAMP",date("Y-m-d H:i:s"));
define("GOOGLE_API_KEY","AIzaSyCCumSa1SxK_bh-OSLAgaVzK5DskXXOWEo");

$shsprog = [
    "AGRICULTURAL SCIENCE",
    "BUSINESS",
    "GENERAL SCIENCE",
    "GENERAL ARTS",
    "HOME SCIENCE",
    "TECHNICAL / VOCATIONAL",
    "VISUAL ARTS"
];
$shs = [
    "ABAKRAMPA SENIOR HIGH/TECH SCHOOL",
    "ABEADZE STATE COLLEGE",
    "ABEASEMAN COMM. DAY SENIOR HIGH SCHOOL",
    "ABETIFI PRESBY SENIOR HIGH SCHOOL",
    "ABETIFI TECH. INST.",
    "ABOR SENIOR HIGH SCHOOL",
    "ABRAFI SENIOR HIGH SCHOOL",
    "ABUADI/TSREFE SENIOR HIGH SCHOOL",
    "ABUAKWA STATE COLLEGE",
    "ABURAMAN SENIOR HIGH SCHOOL",
    "ABURI GIRLS SENIOR HIGH SCHOOL",
    "ABUTIA SENIOR HIGH/TCHNICAL SCHOOL",
    "ACADEMY OF CHRIST THE KING, CAPE COAST",
    "ACCRA ACADEMY",
    "ACCRA GIRLS SENIOR HIGH SCHOOL",
    "ACCRA SENIOR HIGH SCHOOL",
    "ACCRA TECH. TRG. CENTRE",
    "ACCRA WESLEY GIRLS SENIOR HIGH SCHOOL",
    "ACHERENSUA SENIOR HIGH SCHOOL",
    "ACHIASE SENIOR HIGH SCHOOL",
    "ACHIMOTA SENIOR HIGH SCHOOL",
    "ACHINAKROM SENIOR HIGH SCHOOL",
    "ADA SENIOR HIGH SCHOOL",
    "ADA SENIOR HIGH/TECH SCHOOL",
    "ADA TECH. INST.",
    "ADAKLU SENIOR HIGH SCHOOL",
    "ADANKWAMAN SENIOR HIGH SCHOOL",
    "ADANWOMASE SENIOR HIGH SCHOOL",
    "ADEISO PRESBY SENIOR HIGH SCHOOL",
    "ADIDOME SENIOR HIGH SCHOOL",
    "ADIEMBRA SENIOR HIGH SCHOOL",
    "ADISADEL COLLEGE",
    "ADJEN KOTOKU SENIOR HIGH SCHOOL",
    "ADJENA SENIOR HIGH/TECH SCHOOL",
    "ADJOAFUA COMM. SENIOR HIGH SCHOOL",
    "ADOBEWORA COMM. SENIOR HIGH SCHOOL",
    "ADONTEN SENIOR HIGH SCHOOL",
    "ADU GYAMFI SENIOR HIGH SCHOOL",
    "ADUGYAMA COMM. SENIOR HIGH SCHOOL",
    "ADUMAN SENIOR HIGH SCHOOL",
    "ADVENTIST GIRLS SENIOR HIGH SCHOOL, NTONSO",
    "ADVENTIST SENIOR HIGH SCHOOL, KUMASI",
    "AFADJATO SENIOR HIGH/TECH SCHOOL",
    "AFIFE SENIOR HIGH TECH SCHOOL",
    "AFIGYAMAN SENIOR HIGH SCHOOL",
    "AFUA KOBI AMPEM GIRLS' SENIOR HIGH SCHOOL",
    "AGATE COMM. SENIOR HIGH SCHOOL",
    "AGGREY MEM. A.M.E.ZION SENIOR HIGH SCHOOL",
    "AGOGO STATE COLLEGE",
    "AGONA FANKOBAA SENIOR HIGH SCHOOL",
    "AGONA NAMONWORA COMM.SENIOR HIGH SCHOOL",
    "AGONA SENIOR HIGH/TECH SCHOOL",
    "AGOTIME SENIOR HIGH SCHOOL",
    "AGRIC NZEMA SENIOR HIGH SCHOOL, KUMASI",
    "AHAFOMAN SENIOR HIGH/TECH SCHOOL",
    "AHAMANSU ISLAMIC SENIOR HIGH SCHOOL",
    "AHANTAMAN GIRLS' SENIOR HIGH SCHOOL",
    "AKATSI SENIOR HIGH/TECH SCHOOL",
    "AKIM ASAFO SENIOR HIGH SCHOOL",
    "AKIM SWEDRU SENIOR HIGH SCHOOL",
    "AKOKOASO SENIOR HIGH/TECH SCHOOL",
    "AKOME SENIOR HIGH/TECH SCHOOL",
    "AKONTOMBRA SENIOR HIGH SCHOOL",
    "AKPAFU SENIOR HIGH/TECH SCHOOL",
    "AKRO SENIOR HIGH/TECH SCHOOL",
    "AKROFUOM SENIOR HIGH/TECH SCHOOL",
    "AKROSO SENIOR HIGH/TECH SCHOOL",
    "AKUMADAN SENIOR HIGH SCHOOL",
    "AKUSE METHODIST SENIOR HIGH/TECH SCHOOL",
    "AKWAMUMAN SENIOR HIGH SCHOOL",
    "AKWATIA TECH. INST.",
    "AKWESI AWOBAA SENIOR HIGH SCHOOL",
    "AKYIN SENIOR HIGH SCHOOL",
    "ALAVANYO SENIOR HIGH/TECH SCHOOL",
    "AL-AZARIYA ISLAMIC SENIOR HIGH SCHOOL,KUMASI",
    "AMANIAMPONG SENIOR HIGH SCHOOL",
    "AMANKWAKROM FISHERIES AGRIC. TECH. INST.",
    "AMANTEN SENIOR HIGH SCHOOL",
    "AMASAMAN SENIOR HIGH/TECH SCHOOL",
    "AMEDZOFE TECHNICAL INSTITUTE",
    "AMENFIMAN SENIOR HIGH SCHOOL",
    "AMEYAW AKUMFI SENIOR HIGH/TECH SCHOOL",
    "AMOANA PRASO SENIOR HIGH SCHOOL",
    "ANBARIYA SENIOR HIGH SCHOOL",
    "ANFOEGA SENIOR HIGH SCHOOL",
    "ANGLICAN SENIOR HIGH SCHOOL, KUMASI",
    "ANLO AFIADENYIGBA SENIOR HIGH SCHOOL",
    "ANLO AWOMEFIA SENIOR HIGH SCHOOL",
    "ANLO SENIOR HIGH SCHOOL",
    "ANLO TECH. INST.",
    "ANNOR ADJAYE SENIOR HIGH SCHOOL",
    "ANTOA SENIOR HIGH SCHOOL",
    "ANUM APAPAM COMM. DAY SENIOR HIGH SCHOOL",
    "ANUM PRESBY SENIOR HIGH SCHOOL",
    "APAM SENIOR HIGH SCHOOL",
    "APEDWA PRESBY SENIOR HIGH SCHOOL",
    "APEGUSO SENIOR HIGH SCHOOL",
    "APERADE SENIOR HIGH/TECH SCHOOL",
    "ARCHBISHOP PORTER GIRLS SENIOR HIGH SCHOOL",
    "ARMED FORCES SENIOR HIGH/TECH SCHOOL,KUMASI",
    "ASAMANKESE SENIOR HIGH SCHOOL",
    "ASANKRANGWA SENIOR HIGH SCHOOL",
    "ASANKRANGWA SENIOR HIGH/TECH SCHOOL",
    "ASANTEMAN SENIOR HIGH SCHOOL",
    "ASARE BEDIAKO SENIOR HIGH SCHOOL",
    "ASAWINSO SENIOR HIGH SCHOOL",
    "ASESEWA SENIOR HIGH SCHOOL",
    "ASHIAMAN SENIOR HIGH SCHOOL",
    "ASHIAMAN TECH/VOC. INST.",
    "ASSIN MANSO SENIOR HIGH SCHOOL",
    "ASSIN NORTH SENIOR HIGH/TECH SCHOOL",
    "ASSIN NSUTA SENIOR HIGH SCHOOL",
    "ASSIN STATE COLLEGE",
    "ASUANSI TECH. INST.",
    "ASUKAWKAW SENIOR HIGH SCHOOL",
    "ASUOM SENIOR HIGH SCHOOL",
    "ASUOSO COMM. SENIOR HIGH SCHOOL",
    "ATEBUBU SENIOR HIGH SCHOOL",
    "ATIAVI SENIOR HIGH/TECH SCHOOL",
    "ATTAFUAH SENIOR HIGH/TECH SCHOOL",
    "ATWEAMAN SENIOR HIGH SCHOOL",
    "ATWIMA KWANWOMA SENIOR HIGH/TECH SCHOOL",
    "AVATIME SENIOR HIGH SCHOOL",
    "AVE SENIOR HIGH SCHOOL",
    "AVENOR SENIOR HIGH SCHOOL",
    "AVEYIME BATTOR SENIOR HIGH/TECH SCHOOL",
    "AWE SENIOR HIGH/TECH SCHOOL",
    "AWUDOME SENIOR HIGH SCHOOL",
    "AWUTU BAWJIASE COMM SENIOR HIGH SCHOOL",
    "AWUTU WINTON SENIOR HIGH SCHOOL",
    "AXIM GIRLS SENIOR HIGH SCHOOL",
    "AYANFURI SENIOR HIGH SCHOOL",
    "AYIREBI SENIOR HIGH SCHOOL",
    "AZEEM-NAMOA SENIOR HIGH/TECH SCHOOL",
    "BADU SENIOR HIGH/TECH SCHOOL",
    "BAGLO RIDGE SENIOR HIGH/TECH SCHOOL",
    "BAIDOO BONSOE SENIOR HIGH/TECH SCHOOL",
    "BAMBOI COMM. SENIOR HIGH SCHOOL",
    "BANDAMAN SENIOR HIGH SCHOOL",
    "BANKA COMM. SENIOR HIGH SCHOOL",
    "BANKOMAN SENIOR HIGH SCHOOL",
    "BAREKESE SENIOR HIGH SCHOOL",
    "BASSA COMMUNITY SENIOR HIGH SCHOOL",
    "BATTOR SENIOR HIGH SCHOOL",
    "BAWKU SENIOR HIGH SCHOOL",
    "BAWKU SENIOR HIGH/TECH SCHOOL",
    "BAWKU TECH. INST.",
    "BECHEM PRESBY SENIOR HIGH SCHOOL",
    "BENKUM SENIOR HIGH SCHOOL",
    "BENSO SENIOR HIGH/TECH SCHOOL",
    "BEPONG SENIOR HIGH SCHOOL",
    "BEPOSO SENIOR HIGH SCHOOL",
    "BEREKUM PRESBY SENIOR HIGH SCHOOL",
    "BEREKUM SENIOR HIGH SCHOOL",
    "BIA SENIOR HIGH/TECH SCHOOL",
    "BIAKOYE COMM. DAY SCHOOL",
    "BIBIANI SENIOR HIGH/TECH SCHOOL",
    "BIMBILLA SENIOR HIGH SCHOOL",
    "BINDURI COMM. SENIOR HIGH SCHOOL",
    "BIRIFOH SENIOR HIGH SCHOOL",
    "BISEASE SENIOR HIGH/COMM. SCHOOL",
    "BISHOP HERMAN COLLEGE",
    "BOA-AMPONSEM SENIOR HIGH SCHOOL",
    "BOAKYE TROMO SENIOR HIGH/TECH SCHOOL",
    "BODI SENIOR HIGH SCHOOL",
    "BODOMASE SENIOR HIGH/TECH SCHOOL",
    "BODWESANGO SENIOR HIGH SCHOOL",
    "BOLE SENIOR HIGH SCHOOL",
    "BOLGA GIRLS SENIOR HIGH SCHOOL",
    "BOLGA SHERIGU COMM. SENIOR HIGH SCHOOL",
    "BOLGA TECH. INST.",
    "BOLGATANGA SENIOR HIGH SCHOOL",
    "BOMAA COMM. SENIOR HIGH SCHOOL",
    "BOMPATA PRESBY SENIOR HIGH SCHOOL",
    "BOMPEH SENIOR HIGH./TECH SCHOOL",
    "BONGO SENIOR HIGH SCHOOL",
    "BONTRASE SENIOR HIGH TECH. SCHOOL",
    "BONWIRE SENIOR HIGH/TECH SCHOOL",
    "BONZO-KAKU SENIOR HIGH SCHOOL",
    "BOSO SENIOR HIGH TECHNICAL SCHOOL",
    "BOSOME SENIOR HIGH/TECH. SCHOOL",
    "BOSOMTWE OYOKO COMM. SENIOR HIGH SCHOOL",
    "BOWIRI COMM. DAY SCHOOL",
    "BRAKWA SENIOR HIGH/TECH SCHOOL",
    "BREMAN ASIKUMA SENIOR HIGH SCHOOL",
    "BUEMAN SENIOR HIGH SCHOOL",
    "BUIPE SENIOR HIGH SCHOOL",
    "BUIPE TECH/VOC INST.",
    "BUNKPURUGU SENIOR HIGH/TECH SCHOOL",
    "BUSINESS SENIOR HIGH SCHOOL, TAMALE",
    "BUSUNYA SENIOR HIGH SCHOOL",
    "C.Y.O.VOC. TECH. INST.",
    "CAPE COAST TECH. INST.",
    "CHEMU SENIOR HIGH/TECH SCHOOL",
    "CHEREPONI SENIOR HIGH/TECH SCHOOL",
    "CHIANA SENIOR HIGH SCHOOL",
    "CHIRAA SENIOR HIGH SCHOOL",
    "CHIRANO COMM. DAY SENIOR HIGH SCHOOL",
    "CHRIST THE KING CATH., OBUASI",
    "CHRISTIAN METHODIST SENIOR HIGH SCHOOL",
    "CHURCH OF CHRIST SENIOR HIGH SCHOOL",
    "COLLEGE OF MUSIC SENIOR HIGH SCHOOL, MOZANO",
    "COLLINS SENIOR HIGH/COMMERCIAL SCHOOL,AGOGO",
    "COMBONI TECH/VOC INST.",
    "DABALA SENIOR HIGH/TECH.",
    "DABOASE SENIOR HIGH/TECH SCHOOL",
    "DABOKPA VOC/TECH. INST.",
    "DABOYA COMM. DAY SCHOOL",
    "DADEASE AGRIC SENIOR HIGH SCHOOL",
    "DADIESO SENIOR HIGH SCHOOL",
    "DAFFIAMAH SENIOR HIGH SCHOOL",
    "DAGBON STATE SENIOR HIGH/TECH SCHOOL",
    "DAMONGO SENIOR HIGH SCHOOL",
    "DENYASEMAN CATH.SENIOR HIGH SCHOOL",
    "DERMA COMM. DAY SENIOR HIGH SCHOOL",
    "DIABENE SENIOR HIGH/TECH SCHOOL",
    "DIAMONO SENIOR HIGH SCHOOL",
    "DIASO SENIOR HIGH SCHOOL",
    "DIASPORA GIRLS' SENIOR HIGH SCHOOL",
    "DODI-PAPASE SENIOR HIGH/TECH SCHOOL",
    "DOFOR SENIOR HIGH SCHOOL",
    "DOMPOASE SENIOR HIGH SCHOOL",
    "DON BOSCO VOC./TECH. INST.",
    "DONKORKROM AGRIC SENIOR HIGH SCHOOL",
    "DORMAA SENIOR HIGH SCHOOL",
    "DR. HILA LIMAN SENIOR HIGH SCHOOL",
    "DROBO SENIOR HIGH SCHOOL",
    "DUADASO NO. 1 SENIOR HIGH/TECH SCHOOL",
    "DUNKWA SENIOR HIGH/TECH SCHOOL",
    "DWAMENA AKENTEN SENIOR HIGH SCHOOL",
    "DZODZE PENYI SENIOR HIGH SCHOOL",
    "DZOLO SENIOR HIGH SCHOOL",
    "E. P. AGRIC SENIOR HIGH/TECH SCHOOL",
    "E. P. SENIOR HIGH SCHOOL",
    "E. P. TECHNICAL VOCATIONAL INSTITUTE ALAVANYO",
    "E.P.C. MAWUKO GIRLS SENIOR HIGH SCHOOL",
    "EBENEZER SENIOR HIGH SCHOOL",
    "EDINAMAN SENIOR HIGH SCHOOL",
    "EFFIDUASE SENIOR HIGH/COM SCHOOL",
    "EFFIDUASE SENIOR HIGH/TECH SCHOOL",
    "EFFUTU SENIOR HIGH/TECH SCHOOL",
    "EGUAFO-ABREM SENIOR HIGH SCHOOL",
    "EJISU SENIOR HIGH/TECH SCHOOL",
    "EJISUMAN SENIOR HIGH SCHOOL",
    "EJURAMAN ANGLICAN SENIOR HIGH SCHOOL",
    "EKUMFI T. I. AHMADIIYYA SENIOR HIGH SCHOOL",
    "ENYAN DENKYIRA SENIOR HIGH SCHOOL",
    "ENYAN MAIM COMM. DAY SENIOR HIGH SCHOOL",
    "ENYAN-ABAASA TECHNICAL INSTITUTE",
    "EREMON SENIOR HIGH/TECH SCHOOL",
    "ESAASE BONTEFUFUO SNR. HIGH/TECH. SCHOOL",
    "ESIAMA SENIOR HIGH/TECH SCHOOL",
    "FETTEHMAN SENIOR HIGH SCHOOL",
    "FIASEMAN SENIOR HIGH SCHOOL",
    "FIJAI SENIOR HIGH SCHOOL",
    "FODOA COMM. SENIOR HIGH SCHOOL",
    "FOMENA T.I. AHMAD SENIOR HIGH SCHOOL",
    "FORCES SENIOR HIGH/TECH SCHOOL, BURMA CAMP",
    "FR. DOGLI MEMORIAL VOC.TECH. INST.",
    "FRAFRAHA COMM. SENIOR HIGH SCHOOL",
    "FUMBISI SENIOR HIGH SCHOOL",
    "FUNSI SENIOR HIGH SCHOOL",
    "GAMBAGA GIRLS SENIOR HIGH SCHOOL",
    "GAMBIGO COMM. DAY SENIOR HIGH SCHOOL",
    "GARU COMM. DAY SENIOR HIGH SCHOOL",
    "GHANA MUSLIM MISSION SENIOR HIGH SCHOOL",
    "GHANA NATIONAL COLLEGE",
    "GHANA SENIOR HIGH SCHOOL, KOFORIDUA",
    "GHANA SENIOR HIGH SCHOOL, TAMALE",
    "GHANA SENIOR HIGH/TECH SCHOOL",
    "GHANATA SENIOR HIGH SCHOOL",
    "GOKA SENIOR HIGH/TECH SCHOOL",
    "GOMOA GYAMAN SENIOR HIGH SCHOOL",
    "GOMOA SENIOR HIGH/TECH SCHOOL",
    "GOWRIE SENIOR HIGH/TECH SCHOOL",
    "GUAKRO EFFAH SENIOR HIGH SCHOOL",
    "GUSHEGU SENIOR HIGH SCHOOL",
    "GWIRAMAN COMM.SENIOR HIGH SCHOOL",
    "GYAAMA PENSAN SENIOR HIGH/TECH SCHOOL",
    "GYAASE COMMUNITY SENIOR HIGH SCHOOL",
    "GYAMFI KUMANINI SENIOR HIGH/TECH SCHOOL",
    "GYARKO COMM. DAY SENIOR HIGH SCHOOL",
    "HALF ASSINI SENIOR HIGH SCHOOL",
    "HAN SENIOR HIGH SCHOOL",
    "HAVE TECH. INST.",
    "H'MOUNT SINAI SENIOR HIGH SCHOOL",
    "HOLY CHILD SCHOOL, CAPE COAST",
    "HOLY FAMILY SENIOR HIGH SCHOOL",
    "HOLY TRINITY SENIOR HIGH SCHOOL",
    "HUNI VALLEY SENIOR HIGH SCHOOL",
    "HWIDIEM SENIOR HIGH SCHOOL",
    "ISLAMIC GIRLS SENIOR HIGH SCHOOL,SUHUM",
    "ISLAMIC SCIENCE SENIOR HIGH SCHOOL, TAMALE",
    "ISLAMIC SENIOR HIGH SCHOOL, AMPABAME",
    "ISLAMIC SENIOR HIGH SCHOOL, WA",
    "ISTIQUAAMA SENIOR HIGH SCHOOL",
    "J.E.A. MILLS SENIOR HIGH SCHOOL",
    "J.G. KNOL VOC. TECH. INST.",
    "JACHIE PRAMSO SENIOR HIGH SCHOOL",
    "JACOBU SENIOR HIGH/TECH. SCHOOL",
    "JAMIAT AL-HIDAYA ISLAMIC GIRLS SENIOR HIGH SCHOOL",
    "JANGA SENIOR HIGH/TECH SCHOOL",
    "JEMA SENIOR HIGH SCHOOL",
    "JIM BOURTON MEM AGRIC. SENIOR HIGH SCHOOL",
    "JINIJINI SENIOR HIGH SCHOOL",
    "JIRAPA SENIOR HIGH SCHOOL",
    "JUABEN SENIOR HIGH SCHOOL",
    "JUABOSO SENIOR HIGH SCHOOL",
    "JUASO SENIOR HIGH/TECH SCHOOL",
    "JUBILEE SENIOR HIGH SCHOOL",
    "JUKWA SENIOR HIGH SCHOOL",
    "KADE SENIOR HIGH/TECH SCHOOL",
    "KADJEBI-ASATO SENIOR HIGH SCHOOL",
    "KAJAJI SENIOR HIGH SCHOOL",
    "KALEO SENIOR HIGH/TECH SCHOOL",
    "KALPOHIN SENIOR HIGH SCHOOL",
    "KANESHIE SENIOR HIGH/TECH SCHOOL",
    "KANJAGA COMM. SENIOR HIGH SCHOOL",
    "KANTON SENIOR HIGH SCHOOL",
    "KARAGA SENIOR HIGH SCHOOL",
    "KASULIYILI SENIOR HIGH SCHOOL",
    "KESSE BASAHYIA SENIOR HIGH SCHOOL",
    "KETA BUSINESS SENIOR HIGH SCHOOL",
    "KETA SENIOR HIGH/TECH SCHOOL",
    "KETE KRACHI SENIOR HIGH/TECH SCHOOL",
    "KIBI SENIOR HIGH/TECH SCHOOL",
    "KIKAM TECH. INST.",
    "KINBU SENIOR HIGH/TECH SCHOOL",
    "KINTAMPO SENIOR HIGH SCHOOL",
    "KLIKOR SENIOR HIGH/TECH SCHOOL",
    "KLO-AGOGO SENIOR HIGH SCHOOL",
    "KNUST SENIOR HIGH SCHOOL",
    "KO SENIOR HIGH SCHOOL",
    "KOASE SENIOR HIGH/TECH SCHOOL",
    "KOFI ADJEI SENIOR HIGH/TECH SCHOOL",
    "KOFIASE ADVENTIST SENIOR HIGH/TECH. SCHOOL",
    "KOFORIDUA SENIOR HIGH/TECH SCHOOL",
    "KOFORIDUA TECH. INST.",
    "KOMENDA SENIOR HIGH/TECH SCHOOL",
    "KONADU YIADOM CATHOLIC SENIOR HIGH SCHOOL",
    "KONGO SENIOR HIGH SCHOOL",
    "KONONGO ODUMASE SENIOR HIGH SCHOOL",
    "KPANDAI SENIOR HIGH SCHOOL",
    "KPANDO SENIOR HIGH SCHOOL",
    "KPANDO TECH. INST.",
    "KPASSA SENIOR HIGH/TECH SCHOOL",
    "KPEDZE SENIOR HIGH SCHOOL",
    "KPEVE SENIOR HIGH SCHOOL",
    "KPONE COMM. SENIOR HIGH SCHOOL",
    "KRABOA-COALTAR PRESBY SENIOR HIGH SCHOOL HIGH/TECH.",
    "KRACHI SENIOR HIGH SCHOOL",
    "KROBEA ASANTE TECH/VOC SCHOOL",
    "KROBO COMM.SENIOR HIGH SCHOOL",
    "KROBO GIRLS SENIOR HIGH SCHOOL",
    "KUKUOM AGRIC SENIOR HIGH SCHOOL",
    "KUMASI ACADEMY",
    "KUMASI GIRLS SENIOR HIGH SCHOOL",
    "KUMASI SENIOR HIGH SCHOOL",
    "KUMASI SENIOR HIGH/TECH SCHOOL",
    "KUMASI TECH. INST.",
    "KUMASI WESLEY GIRLS HIGH SCHOOL",
    "KUMBUNGU SENIOR HIGH SCHOOL",
    "KUROFA METHODIST SENIOR HIGH SCHOOL",
    "KUSANABA SENIOR HIGH SCHOOL",
    "KWABENG ANGLICAN SENIOR HIGH/TECH SCHOOL",
    "KWABENYA COMM. SENIOR HIGH SCHOOL",
    "KWABRE SENIOR HIGH SCHOOL",
    "KWAHU RIDGE SENIOR HIGH SCHOOL",
    "KWAHU TAFO SENIOR HIGH SCHOOL",
    "KWAME DANSO SENIOR HIGH/TECH SCHOOL",
    "KWANWOMA SENIOR HIGH SCHOOL",
    "KWANYAKO SENIOR HIGH SCHOOL",
    "KWAOBAAH NYANOA COMM. SENIOR HIGH SCHOOL",
    "KWARTENG ANKOMAH SENIOR HIGH SCHOOL",
    "KWEGYIR AGGREY SENIOR HIGH SCHOOL",
    "KYABOBO GIRLS SENIOR HIGH SCHOOL",
    "LA PRESBY SENIOR HIGH SCHOOL",
    "LABONE SENIOR HIGH SCHOOL",
    "LAMBUSSIE COMM SENIOR HIGH SCHOOL",
    "LANGBINSI SENIOR HIGH TECHNICAL SCHOOL",
    "LASHIBI COMMUNITY SENIOR HIGH SCHOOL",
    "LASSIE-TUOLU SENIOR HIGH SCHOOL",
    "LAWRA SENIOR HIGH SCHOOL",
    "LEKLEBI SENIOR HIGH SCHOOL",
    "LIKPE SENIOR HIGH SCHOOL",
    "LOGGU COMM. DAY SCHOOL",
    "MAABANG SENIOR HIGH/TECH SCHOOL",
    "MAAME KROBO COMM. SENIOR HIGH SCHOOL",
    "MAFI-KUMASI SENIOR HIGH/TECH SCHOOL",
    "MAMPONG/AKW SENIOR HIGH/TECH SCHOOL FOR THE DEAF",
    "MANDO SENIOR HIGH/TECH SCHOOL",
    "MANGOASE SENIOR HIGH SCHOOL",
    "MANKESSIM SENIOR HIGH/TECH SCHOOL",
    "MANKRANSO SENIOR HIGH SCHOOL",
    "MANSEN SENIOR HIGH SCHOOL",
    "MANSO-ADUBIA SENIOR HIGH SCHOOL",
    "MANSO-AMENFI COMM. DAY SENIOR HIGH SCHOOL",
    "MANSOMAN SENIOR HIGH SCHOOL",
    "MANYA KROBO SENIOR HIGH SCHOOL",
    "MAWULI SCHOOL, HO",
    "MEM-CHEMFRE COMM. SENIOR HIGH SCHOOL",
    "MENJI SENIOR HIGH SCHOOL",
    "MEPE ST. KIZITO SENIOR HIGH/TECH SCHOOL",
    "METHODIST GIRLS SENIOR HIGH SCHOOL, MAMFE",
    "METHODIST HIGH SCHOOL,SALTPOND",
    "METHODIST SENIOR HIGH SCHOOL, SEKONDI",
    "METHODIST SENIOR HIGH/TECH SCHOOL,BIADAN",
    "METHODIST TECHNINCAL INSTITUTE",
    "MFANTSIMAN GIRLS SENIOR HIGH SCHOOL",
    "MFANTSIPIM SCHOOL",
    "MIM SENIOR HIGH SCHOOL",
    "MIRIGU COMMUNITY DAY SENIOR HIGH SCHOOL",
    "MOKWAA SENIOR HIGH SCHOOL",
    "MOREE COMM. SENIOR HIGH SCHOOL",
    "MOZANO SENIOR HIGH SCHOOL",
    "MPAHA COMMUNITY DAY SENIOR HIGH SCHOOL",
    "MPASATIA SENIOR HIGH/TECH SCHOOL",
    "MPOHOR SENIOR HIGH SCHOOL",
    "MPRAESO SENIOR HIGH SCHOOL",
    "NABANGO SENIOR HIGH SCHOOL",
    "NAFANA SENIOR HIGH SCHOOL",
    "NAKPANDURI SENIOR HIGH SCHOOL",
    "NALERIGU SENIOR HIGH SCHOOL",
    "NAMONG SENIOR HIGH/TECH SCHOOL",
    "NANA BRENTU SENIOR HIGH/TECH SCHOOL",
    "NANDOM SENIOR HIGH SCHOOL",
    "NAVRONGO SENIOR HIGH SCHOOL",
    "NCHUMURUMAN COMM. DAY SENIOR HIGH SCHOOL",
    "NDEWURA JAKPA SENIOR HIGH/TECH SCHOOL",
    "NEW ABIREM/AFOSU SENIOR HIGH SCHOOL",
    "NEW EDUBIASE SENIOR HIGH SCHOOL",
    "NEW JUABEN SENIOR HIGH/COMM SCHOOL",
    "NEW KROKOMPE COMM. SENIOR HIGH SCHOOL",
    "NEW LONGORO COMM SENIOR HIGH SCHOOL (DEGA)",
    "NEW NSUTAM SENIOR HIGH/TECH SCHOOL",
    "NGLESHIE AMANFRO SENIOR HIGH SCHOOL",
    "NIFA SENIOR HIGH SCHOOL",
    "NINGO SENIOR HIGH SCHOOL",
    "NKAWIE SENIOR HIGH/TECH SCHOOL",
    "NKAWKAW SENIOR HIGH SCHOOL",
    "NKENKANSU COMMUNITY SENIOR HIGH SCHOOL",
    "NKONYA SENIOR HIGH SCHOOL",
    "NKORANMAN SENIOR HIGH SCHOOL",
    "NKORANZA SENIOR HIGH/TECH SCHOOL",
    "NKORANZA TECH INST.",
    "NKRANKWANTA COMM SENIOR HIGH SCHOOL",
    "NKROFUL AGRIC. SENIOR HIGH SCHOOL",
    "NKWANTA COMM SENIOR HIGH SCHOOL",
    "NKWANTA SENIOR HIGH SCHOOL",
    "NKWATIA PRESBY SENIOR HIGH/COMM SCHOOL",
    "NKYERAA SENIOR HIGH SCHOOL",
    "NORTHERN SCHOOL OF BUSINESS",
    "NORTHERN STAR SENIOR HIGH SCHOOL",
    "NOTRE DAME GIRLS SENIOR HIGH SCHOOL,SUNYANI",
    "NOTRE DAME SEM/ SENIOR HIGH SCHOOL NAVRONGO",
    "NSABA PRESBY SENIOR HIGH SCHOOL",
    "NSAWAM SENIOR HIGH SCHOOL",
    "NSAWKAW STATE SENIOR HIGH SCHOOL",
    "NSAWORA EDUMAFA COMM. SENIOR HIGH SCHOOL",
    "NSEIN SENIOR HIGH SCHOOL",
    "NSUTAMAN CATH. SENIOR HIGH SCHOOL",
    "NTRUBOMAN SENIOR HIGH SCHOOL",
    "NUNGUA SENIOR HIGH SCHOOL",
    "NURU-AMEEN ISLAMIC SENIOR HIGH SCHOOL, ASEWASE",
    "NYAKROM SENIOR HIGH TECH SCHOOL",
    "NYANKUMASE AHENKRO SENIOR HIGH SCHOOL",
    "NYINAHIN CATH. SENIOR HIGH SCHOOL",
    "O.L.L. GIRLS SENIOR HIGH SCHOOL",
    "OBIRI YEBOAH SENIOR HIGH/TECHNICAL SCHOOL",
    "OBRACHIRE SENIOR HIGH/TECH SCHOOL",
    "OBUASI SENIOR HIGH/TECH SCHOOL",
    "ODA SENIOR HIGH SCHOOL",
    "ODOBEN SENIOR HIGH SCHOOL",
    "ODOMASEMAN SENIOR HIGH SCHOOL",
    "ODORGONNO SENIOR HIGH SCHOOL",
    "ODUPONG COMM. DAY SCHOOL",
    "OFOASE KOKOBEN SENIOR HIGH SCHOOL",
    "OFOASE SENIOR HIGH/TECH SCHOOL",
    "OFORI PANIN SENIOR HIGH SCHOOL",
    "OGUAA SENIOR HIGH/TECH SCHOOL",
    "OGYEEDOM COMM SENIOR HIGH/TECH SCHOOL",
    "OKADJAKROM SENIOR HIGH/TECH SCHOOL",
    "OKOMFO ANOKYE SENIOR HIGH SCHOOL",
    "OKUAPEMAN SENIOR HIGH SCHOOL",
    "OLA GIRLS SENIOR HIGH SCHOOL, HO",
    "OLA GIRLS SENIOR HIGH SCHOOL, KENYASI",
    "ONWE SENIOR HIGH SCHOOL",
    "OPOKU AGYEMAN SENIOR HIGH/TECH SCHOOL",
    "OPOKU WARE SENIOR HIGH SCHOOL",
    "OPPONG MEM. SENIOR HIGH SCHOOL",
    "O'REILLY SENIOR HIGH SCHOOL",
    "OSEI ADUTWUM SENIOR HIGH SCHOOL",
    "OSEI BONSU SENIOR HIGH SCHOOL",
    "OSEI KYERETWIE SENIOR HIGH SCHOOL",
    "OSEI TUTU SENIOR HIGH SCHOOL, AKROPONG",
    "OSINO PRESBY SENIOR HIGH/TECH SCHOOL",
    "OSUDOKU SENIOR HIGH/TECH SCHOOL",
    "OTI BOATENG SENIOR HIGH SCHOOL",
    "OTI SENIOR HIGH/TECH SCHOOL",
    "OTUMFUO OSEI TUTU II COLLEGE",
    "OUR LADY OF MERCY SENIOR HIGH SCHOOL",
    "OUR LADY OF MOUNT CARMEL GIRLS SENIOR HIGH SCHOOL, TECHIMAN",
    "OUR LADY OF PROVIDENCE SENIOR HIGH SCHOOL",
    "OWERRIMAN SENIOR HIGH SCHOOL",
    "OYOKO METHODIST SENIOR HIGH SCHOOL",
    "PAGA SENIOR HIGH SCHOOL",
    "PARKOSO COMM. SENIOR HIGH SCHOOL",
    "PEKI SENIOR HIGH SCHOOL",
    "PEKI SENIOR HIGH/TECHNICAL SCHOOL",
    "PENTECOST SENIOR HIGH SCHOOL, KUMASI",
    "PENTECOST SENIOR HIGH SCHOOL,KOFORIDUA",
    "PIINA SENIOR HIGH SCHOOL",
    "PONG-TAMALE SENIOR HIGH SCHOOL",
    "POPE JOHN SENIOR HIGH & MIN. SEM. SCHOOL, KOFORIDUA",
    "POTSIN T.I. AHM. SENIOR HIGH SCHOOL",
    "PRAMPRAM SENIOR HIGH SCHOOL",
    "PRANG SENIOR HIGH",
    "PREMPEH COLLEGE",
    "PRESBY BOYS SENIOR HIGH SCHOOL, LEGON",
    "PRESBY SENIOR HIGH SCHOOL, BEGORO",
    "PRESBY SENIOR HIGH SCHOOL, MAMPONG AKWAPIM",
    "PRESBY SENIOR HIGH SCHOOL, OSU",
    "PRESBY SENIOR HIGH SCHOOL, SUHUM",
    "PRESBY SENIOR HIGH SCHOOL, TAMALE",
    "PRESBY SENIOR HIGH SCHOOL, TEMA",
    "PRESBY SENIOR HIGH SCHOOL, TESHIE",
    "PRESBY SENIOR HIGH/TECH SCHOOL, ABURI",
    "PRESBY SENIOR HIGH/TECH SCHOOL, ADUKROM",
    "PRESBY SENIOR HIGH/TECH SCHOOL, KWAMANG",
    "PRESBY SENIOR HIGH/TECH SCHOOL, LARTEH",
    "PRESTEA SENIOR HIGH/TECH SCHOOL",
    "PRINCE OF PEACE GIRLS",
    "QUEEN OF PEACE SENIOR HIGH SCHOOL, NADOWLI",
    "QUEENS GIRLS' SENIOR HIGH SCHOOL, SEFWI AWHIASO",
    "S.D.A SENIOR HIGH SCHOOL, KOFORIDUA",
    "S.D.A SENIOR HIGH SCHOOL, SUNYANI",
    "S.D.A. SENIOR HIGH SCHOOL, AGONA",
    "S.D.A. SENIOR HIGH SCHOOL, BEKWAI",
    "S.D.A. SENIOR HIGHSCHOOL, AKIM SEKYERE",
    "SABOBA E.P. SENIOR HIGH SCHOOL",
    "SABRONUM METHODIST SENIOR HIGH/TECHSCHOOL",
    "SACRED HEART SENIOR HIGH SCHOOL, NSOATRE",
    "SACRED HEART TECH. INST.",
    "SAKAFIA ISLAMIC SENIOR HIGH SCHOOL",
    "SAKOGU SENIOR HIGH/TECH SCHOOL",
    "SALAGA SENIOR HIGH SCHOOL",
    "SALAGA T.I. AHMAD SENIOR HIGH SCHOOL",
    "SALVATION ARMY SENIOR HIGH SCHOOL, ABOABO DORMAA",
    "SALVATION ARMY SENIOR HIGH SCHOOL, AKIM WENCHI",
    "SAMUEL OTU PRESBY SENIOR HIGH SCHOOL",
    "SANDEMA SENIOR HIGH SCHOOL",
    "SANDEMA SENIOR HIGH/TECH SCHOOL",
    "SANG COMM. DAY SCHOOL",
    "SANKOR COMM. DAY SENIOR HIGH SCHOOL",
    "SANKORE SENIOR HIGH SCHOOL",
    "SAVELUGU SENIOR HIGH SCHOOL",
    "SAVIOUR SENIOR HIGH SCHOOL, OSIEM",
    "SAWLA SENIOR HIGH SCHOOL",
    "SEFWI BEKWAI SENIOR HIGH SCHOOL",
    "SEFWI-WIAWSO SENIOR HIGH SCHOOL",
    "SEFWI-WIAWSO SENIOR HIGH/TECH SCHOOL",
    "SEKONDI COLLEGE",
    "SEKYEDUMASE SENIOR HIGH/TECH SCHOOL",
    "SENYA SENIOR HIGH SCHOOL",
    "SERWAA KESSE GIRLS SENIOR HIGH SCHOOL",
    "SERWAAH NYARKO GIRLS' SENIOR HIGH SCHOOL",
    "SHAMA SENIOR HIGH SCHOOL",
    "SHIA SENIOR HIGHTECHNICAL SCHOOL",
    "SIDDIQ SENIOR HIGH SCHOOL",
    "SIMMS SENIOR HIGH/COM. SCHOOL",
    "SIRIGU INTEGRATED SENIOR HIGH SCHOOL",
    "SOGAKOPE SENIOR HIGH SCHOOL",
    "SOKODE SENIOR HIGH/TECH SCHOOL",
    "SOMBO SENIOR HIGH SCHOOL",
    "SOME SENIOR HIGH SCHOOL",
    "SPIRITAN SENIOR HIGH SCHOOL",
    "ST. ANN'S GIRLS SENIOR HIGH SCHOOL, SAMPA",
    "ST. ANTHONY OF PADUA SENIOR HIGH/TECH SCHOOL",
    "ST. AUGUSTINE SENIOR HIGH SCHOOL, NSAPOR BEREKUM",
    "ST. AUGUSTINE SENIOR HIGH/TECH SCHOOL, SAAN CHARIKPONG",
    "ST. AUGUSTINE'S COLLEGE, CAPE COAST",
    "ST. AUGUSTINE'S SENIOR HIGH SCHOOL, BOGOSO",
    "ST. BASILIDES VOC./TECH. INST.",
    "ST. BERNADETTES TECH/VOC. INST.",
    "ST. CATHERINE GIRLS SENIOR HIGH SCHOOL",
    "ST. CHARLES SENIOR HIGH SCHOOL, TAMALE",
    "ST. DANIEL COMBONI TECH/VOC INST.",
    "ST. DOMINIC'S SENIOR HIGH/TECH SCHOOL, PEPEASE",
    "ST. FIDELIS SENIOR HIGH/TECH SCHOOL",
    "ST. FRANCIS GIRLS SENIOR HIGH SCHOOL, JIRAPA",
    "ST. FRANCIS SEMINARY/SENIOR HIGH SCHOOL, BUOYEM",
    "ST. FRANCIS SENIOR HIGH/TECH SCHOOL, AKIM ODA",
    "ST. GEORGE'S SENIOR HIGH TECH SCHOOL",
    "ST. GREGORY CATHOLIC SENIOR HIGH SCHOOL",
    "ST. HUBERT SEM/SENIOR HIGH SCHOOL, KUMASI",
    "ST. JAMES SEM & SENIOR HIGH SCHOOL, ABESIM",
    "ST. JEROME SENIOR HIGH SCHOOL, ABOFOUR",
    "ST. JOHN'S GRAMMAR SENIOR HIGH SCHOOL",
    "ST. JOHN'S INTEGRATED SENIOR HIGH/TECH SCHOOL",
    "ST. JOHN'S SENIOR HIGH SCHOOL, SEKONDI",
    "ST. JOSEPH SEM/SENIOR HIGH SCHOOL, MAMPONG",
    "ST. JOSEPH SENIOR HIGH SCHOOL, SEFWI WIAWSO",
    "ST. JOSEPH SENIOR HIGH/TECH SCHOOL, AHWIREN",
    "ST. JOSEPH'S TECH. INST.",
    "ST. JOSEPH'S TECH. INST.",
    "ST. LOUIS SENIOR HIGH SCHOOL, KUMASI",
    "ST. MARGARET MARY SENIOR HIGH/TECH SCHOOL",
    "ST. MARTIN'S SENIOR HIGH SCHOOL, NSAWAM",
    "ST. MARY'S BOYS' SENIOR HIGH SCHOOL, APOWA",
    "ST. MARY'S GIRL'S SENIOR HIGH, KONONGO",
    "ST. MARY'S SEM.& SENIOR HIGH SCHOOL, LOLOBI",
    "ST. MARY'S SENIOR HIGH SCHOOL, KORLE GONNO",
    "ST. MARY'S VOC./TECH. INST.",
    "ST. MICHAEL TECH/VOC INST",
    "ST. MICHAEL'S SENIOR HIGH SCHOOL, AHENKRO",
    "ST. MICHAEL'S SENIOR HIGH SCHOOL, AKOASE (NKAWKAW)",
    "ST. MONICA'S SENIOR HIGH SCHOOL, MAMPONG",
    "ST. PAUL'S SENIOR HIGH SCHOOL, ASAKRAKA KWAHU",
    "ST. PAUL'S SENIOR HIGH SCHOOL, DENU",
    "ST. PAUL'S TECH. SCHOOL",
    "ST. PETER'S SENIOR HIGH SCHOOL, NKWATIA",
    "ST. ROSE'S SENIOR HIGH SCHOOL, AKWATIA",
    "ST. SEBASTIAN CATH. SENIOR HIGH SCHOOL",
    "ST. STEPHEN'S PRESBY SENIOR HIGH/TECH SCHOOL, ASIAKWA",
    "ST. THOMAS AQUINAS SENIOR HIGH SCHOOL,CANTOMENTS",
    "ST. THOMAS SENIOR HIGH/TECH SCHOOL",
    "ST.JOHN'S VOC. TECH. INSTITUTE",
    "SUHUM SENIOR HIGH/TECH SCHOOL",
    "SUMAMAN SENIOR HIGH SCHOOL",
    "SUNYANI METHODIST TECHNICAL INST.",
    "SUNYANI SENIOR HIGH SCHOOL",
    "SWEDRU SCH. OF BUSINESS",
    "SWEDRU SENIOR HIGH SCHOOL",
    "T. I. AHMADIYYA GIRL'S SENIOR HIGH SCHOOL, ASOKORE",
    "T. I. AHMADIYYA SENIOR HIGH SCHOOL, KUMASI",
    "T. I. AHMADIYYA SENIOR HIGH SCHOOL, WA",
    "TAKORADI SENIOR HIGH SCHOOL",
    "TAKORADI TECH. INST.",
    "TAKPO SENIOR HIGH SCHOOL",
    "TAMALE GIRLS SENIOR HIGH SCHOOL",
    "TAMALE SENIOR HIGH SCHOOL",
    "TAMALE TECHNICAL INSTITUTE",
    "TANYIGBE SENIOR HIGH SCHOOL",
    "TAPAMAN SENIOR HIGH/TECH SCHOOL",
    "TARKROSI COMM. SENIOR HIGH SCHOOL",
    "TARKWA SENIOR HIGH SCHOOL",
    "TAVIEFE COMM. SENIOR HIGH SCHOOL",
    "TAWHEED SENIOR HIGH SCHOOL",
    "TECHIMAN SENIOR HIGH SCHOOL",
    "TEMA MANHEAN SENIOR HIGH/TECH SCHOOL",
    "TEMA METH. DAY SENIOR HIGH SCHOOL",
    "TEMA SENIOR HIGH SCHOOL",
    "TEMA TECH. INST.",
    "TEMPANE SENIOR HIGH SCHOOL",
    "TEPA SENIOR HIGH SCHOOL",
    "TERCHIRE SENIOR HIGH SCHOOL",
    "TESHIE TECH. INSTITTUTE",
    "THREE TOWN SENIOR HIGH SCHOOL",
    "TIJJANIYA SENIOR HIGH SCHOOL",
    "TOASE SENIOR HIGH SCHOOL",
    "TOLON SENIOR HIGH SCHOOL",
    "TONGO SENIOR HIGH/TECH SCHOOL",
    "TONGOR SENIOR HIGH TECH SCHOOL",
    "TSIAME SENIOR HIGH SCHOOL",
    "TSITO SENIOR HIGH/TECH SCHOOL",
    "TUMU SENIOR HIGH/TECH SCHOOL",
    "TUNA SENIOR HIGH/TECH SCHOOL",
    "TUOBODOM SENIOR HIGH/TECH SCHOOL",
    "TWEAPEASE SENIOR HIGH SCHOOL",
    "TWENE AMANFO SENIOR HIGH/TECH SCHOOL",
    "TWENEBOA KODUA SENIOR HIGH SCHOOL",
    "TWIFO HEMANG SENIOR HIGH/TECH SCHOOL",
    "TWIFO PRASO SENIOR HIGH SCHOOL",
    "ULLO SENIOR HIGH SCHOOL",
    "UNIVERSITY PRACTICE SENIOR HIGH SCHOOL",
    "UTHMAN BIN AFAM SENIOR HIGH SCHOOL",
    "UTHMANIYA SENIOR HIGH SCHOOL, TAFO",
    "VAKPO SENIOR HIGH SCHOOL",
    "VAKPO SENIOR HIGH/TECH SCHOOL",
    "VE COMM. SENIOR HIGH SCHOOL",
    "VITTING SENIOR HIGH/TECH.",
    "VOLO COMM. SENIOR HIGH SCHOOL",
    "VOLTA SENIOR HIGH SCHOOL",
    "VOLTA TECH INST",
    "W.B.M. ZION SENIOR HIGH SCHOOL, OLD TAFO",
    "WA SENIOR HIGH SCHOOL",
    "WA SENIOR HIGH/TECH SCHOOL",
    "WA TECH. INST.",
    "WALEWALE SENIOR HIGH SCHOOL",
    "WALEWALETECH/ VOC INST.",
    "WAMANAFO SENIOR HIGH/TECH SCHOOL",
    "WAPULI COMM. SENIOR HIGH SCHOOL",
    "WENCHI METH. SENIOR HIGH SCHOOL",
    "WESLEY GIRLS SENIOR HIGH SCHOOL, CAPE COAST",
    "WESLEY GRAMMAR SENIOR HIGH SCHOOL",
    "WESLEY HIGH SCHOOL, BEKWAI",
    "WESLEY SENIOR HIGH SCHOOL, KONONGO",
    "WEST AFRICA SENIOR HIGH SCHOOL",
    "WETA SENIOR HIGH/TECH SCHOOL",
    "WIAFE AKENTEN PRESBY SENIOR HIGH SCHOOL",
    "WIAGA COMM. SENIOR HIGH SCHOOL",
    "WINNEBA SENIOR HIGH SCHOOL",
    "WORAWORA SENIOR HIGH SCHOOL",
    "WOVENU SENIOR HIGH TECHNICAL SCHOOL",
    "WULENSI SENIOR HIGH SCHOOL",
    "WULUGU SENIOR HIGH SCHOOL",
    "YAA ASANTEWAA GIRLS SENIOR HIGH SCHOOL",
    "YABRAM COMM. DAY SCHOOL",
    "YAGABA SENIOR HIGH SCHOOL",
    "YAMFO ANGLICAN SENIOR HIGH SCHOOL",
    "YEBOAH ASUAMAH SENIOR HIGH SCHOOL",
    "YEJI SENIOR HIGH/TECH SCHOOL",
    "YENDI SENIOR HIGH SCHOOL",
    "YILO KROBO SENIOR HIGH/COMM SCHOOL",
    "ZABZUGU SENIOR HIGH SCHOOL",
    "ZAMSE SENIOR HIGH/TECH SCHOOL",
    "ZEBILLA SENIOR HIGH/TECH SCHOOL",
    "ZION SENIOR HIGH SCHOOL",
    "ZIOPE SENIOR HIGH SCHOOL",
    "ZORKOR SENIOR HIGH SCHOOL",
    "ZUARUNGU SENIOR HIGH SCHOOL"
];
$regions = [
    "Ahafo",
    "Ashanti",
    "Bono East",
    "Brong Ahafo",
    "Central",
    "Eastern",
    "Greater Accra",
    "North East",
    "Northern",
    "Oti",
    "Savannah",
    "Upper East",
    "Upper West",
    "Western",
    "Western North",
    "Volta"
];
$nationalityJSON = [
    "Afghan",
    "Albanian",
    "Algerian",
    "American",
    "Andorran",
    "Angolan",
    "Antiguans",
    "Argentinean",
    "Armenian",
    "Australian",
    "Austrian",
    "Azerbaijani",
    "Bahamian",
    "Bahraini",
    "Bangladeshi",
    "Barbadian",
    "Barbudans",
    "Batswana",
    "Belarusian",
    "Belgian",
    "Belizean",
    "Beninese",
    "Bhutanese",
    "Bolivian",
    "Bosnian",
    "Brazilian",
    "British",
    "Bruneian",
    "Bulgarian",
    "Burkinabe",
    "Burmese",
    "Burundian",
    "Cambodian",
    "Cameroonian",
    "Canadian",
    "Cape Verdean",
    "Central African",
    "Chadian",
    "Chilean",
    "Chinese",
    "Colombian",
    "Comoran",
    "Congolese",
    "Costa Rican",
    "Croatian",
    "Cuban",
    "Cypriot",
    "Czech",
    "Danish",
    "Djibouti",
    "Dominican",
    "Dutch",
    "East Timorese",
    "Ecuadorean",
    "Egyptian",
    "Emirian",
    "Equatorial Guinean",
    "Eritrean",
    "Estonian",
    "Ethiopian",
    "Fijian",
    "Filipino",
    "Finnish",
    "French",
    "Gabonese",
    "Gambian",
    "Georgian",
    "German",
    "Ghanaian",
    "Greek",
    "Grenadian",
    "Guatemalan",
    "Guinea-Bissauan",
    "Guinean",
    "Guyanese",
    "Haitian",
    "Herzegovinian",
    "Honduran",
    "Hungarian",
    "I-Kiribati",
    "Icelander",
    "Indian",
    "Indonesian",
    "Iranian",
    "Iraqi",
    "Irish",
    "Israeli",
    "Italian",
    "Ivorian",
    "Jamaican",
    "Japanese",
    "Jordanian",
    "Kazakhstani",
    "Kenyan",
    "Kittian and Nevisian",
    "Kuwaiti",
    "Kyrgyz",
    "Laotian",
    "Latvian",
    "Lebanese",
    "Liberian",
    "Libyan",
    "Liechtensteiner",
    "Lithuanian",
    "Luxembourger",
    "Macedonian",
    "Malagasy",
    "Malawian",
    "Malaysian",
    "Maldivan",
    "Malian",
    "Maltese",
    "Marshallese",
    "Mauritanian",
    "Mauritian",
    "Mexican",
    "Micronesian",
    "Moldovan",
    "Monacan",
    "Mongolian",
    "Moroccan",
    "Mosotho",
    "Motswana",
    "Mozambican",
    "Namibian",
    "Nauruan",
    "Nepalese",
    "New Zealander",
    "Nicaraguan",
    "Nigerian",
    "Nigerien",
    "North Korean",
    "Northern Irish",
    "Norwegian",
    "Omani",
    "Pakistani",
    "Palauan",
    "Panamanian",
    "Papua New Guinean",
    "Paraguayan",
    "Peruvian",
    "Polish",
    "Portuguese",
    "Qatari",
    "Romanian",
    "Russian",
    "Rwandan",
    "Saint Lucian",
    "Salvadoran",
    "Samoan",
    "San Marinese",
    "Sao Tomean",
    "Saudi",
    "Scottish",
    "Senegalese",
    "Serbian",
    "Seychellois",
    "Sierra Leonean",
    "Singaporean",
    "Slovakian",
    "Slovenian",
    "Solomon Islander",
    "Somali",
    "South African",
    "South Korean",
    "Spanish",
    "Sri Lankan",
    "Sudanese",
    "Surinamer",
    "Swazi",
    "Swedish",
    "Swiss",
    "Syrian",
    "Taiwanese",
    "Tajik",
    "Tanzanian",
    "Thai",
    "Togolese",
    "Tongan",
    "Trinidadian or Tobagonian",
    "Tunisian",
    "Turkish",
    "Tuvaluan",
    "Ugandan",
    "Ukrainian",
    "Uruguayan",
    "Uzbekistani",
    "Venezuelan",
    "Vietnamese",
    "Welsh",
    "Yemenite",
    "Zambian",
    "Zimbabwean"
];
$countryJson = [
    "Afghanistan",
    "Åland Islands",
    "Albania",
    "Algeria",
    "American Samoa",
    "Andorra",
    "Angola",
    "Anguilla",
    "Antarctica",
    "Antigua and Barbuda",
    "Argentina",
    "Armenia",
    "Aruba",
    "Australia",
    "Austria",
    "Azerbaijan",
    "Bahamas (the)",
    "Bahrain",
    "Bangladesh",
    "Barbados",
    "Belarus",
    "Belgium",
    "Belize",
    "Benin",
    "Bermuda",
    "Bhutan",
    "Bolivia (Plurinational State of)",
    "Bonaire, Sint Eustatius and Saba",
    "Bosnia and Herzegovina",
    "Botswana",
    "Bouvet Island",
    "Brazil",
    "British Indian Ocean Territory (the)",
    "Brunei Darussalam",
    "Bulgaria",
    "Burkina Faso",
    "Burundi",
    "Cabo Verde",
    "Cambodia",
    "Cameroon",
    "Canada",
    "Cayman Islands (the)",
    "Central African Republic (the)",
    "Chad",
    "Chile",
    "China",
    "Christmas Island",
    "Cocos (Keeling) Islands (the)",
    "Colombia",
    "Comoros (the)",
    "Congo (the Democratic Republic of the)",
    "Congo (the)",
    "Cook Islands (the)",
    "Costa Rica",
    "Croatia",
    "Cuba",
    "Curaçao",
    "Cyprus",
    "Czechia",
    "Côte d'Ivoire",
    "Denmark",
    "Djibouti",
    "Dominica",
    "Dominican Republic (the)",
    "Ecuador",
    "Egypt",
    "El Salvador",
    "Equatorial Guinea",
    "Eritrea",
    "Estonia",
    "Eswatini",
    "Ethiopia",
    "Falkland Islands (the) [Malvinas]",
    "Faroe Islands (the)",
    "Fiji",
    "Finland",
    "France",
    "French Guiana",
    "French Polynesia",
    "French Southern Territories (the)",
    "Gabon",
    "Gambia (the)",
    "Georgia",
    "Germany",
    "Ghana",
    "Gibraltar",
    "Greece",
    "Greenland",
    "Grenada",
    "Guadeloupe",
    "Guam",
    "Guatemala",
    "Guernsey",
    "Guinea",
    "Guinea-Bissau",
    "Guyana",
    "Haiti",
    "Heard Island and McDonald Islands",
    "Holy See (the)",
    "Honduras",
    "Hong Kong",
    "Hungary",
    "Iceland",
    "India",
    "Indonesia",
    "Iran (Islamic Republic of)",
    "Iraq",
    "Ireland",
    "Isle of Man",
    "Israel",
    "Italy",
    "Jamaica",
    "Japan",
    "Jersey",
    "Jordan",
    "Kazakhstan",
    "Kenya",
    "Kiribati",
    "Korea (the Democratic People's Republic of)",
    "Korea (the Republic of)",
    "Kuwait",
    "Kyrgyzstan",
    "Lao People's Democratic Republic (the)",
    "Latvia",
    "Lebanon",
    "Lesotho",
    "Liberia",
    "Libya",
    "Liechtenstein",
    "Lithuania",
    "Luxembourg",
    "Macao",
    "Madagascar",
    "Malawi",
    "Malaysia",
    "Maldives",
    "Mali",
    "Malta",
    "Marshall Islands (the)",
    "Martinique",
    "Mauritania",
    "Mauritius",
    "Mayotte",
    "Mexico",
    "Micronesia (Federated States of)",
    "Moldova (the Republic of)",
    "Monaco",
    "Mongolia",
    "Montenegro",
    "Montserrat",
    "Morocco",
    "Mozambique",
    "Myanmar",
    "Namibia",
    "Nauru",
    "Nepal",
    "Netherlands (the)",
    "New Caledonia",
    "New Zealand",
    "Nicaragua",
    "Niger (the)",
    "Nigeria",
    "Niue",
    "Norfolk Island",
    "Northern Mariana Islands (the)",
    "Norway",
    "Oman",
    "Pakistan",
    "Palau",
    "Palestine, State of",
    "Panama",
    "Papua New Guinea",
    "Paraguay",
    "Peru",
    "Philippines (the)",
    "Pitcairn",
    "Poland",
    "Portugal",
    "Puerto Rico",
    "Qatar",
    "Republic of North Macedonia",
    "Romania",
    "Russian Federation (the)",
    "Rwanda",
    "Réunion",
    "Saint Barthélemy",
    "Saint Helena, Ascension and Tristan da Cunha",
    "Saint Kitts and Nevis",
    "Saint Lucia",
    "Saint Martin (French part)",
    "Saint Pierre and Miquelon",
    "Saint Vincent and the Grenadines",
    "Samoa",
    "San Marino",
    "Sao Tome and Principe",
    "Saudi Arabia",
    "Senegal",
    "Serbia",
    "Seychelles",
    "Sierra Leone",
    "Singapore",
    "Sint Maarten (Dutch part)",
    "Slovakia",
    "Slovenia",
    "Solomon Islands",
    "Somalia",
    "South Africa",
    "South Georgia and the South Sandwich Islands",
    "South Sudan",
    "Spain",
    "Sri Lanka",
    "Sudan (the)",
    "Suriname",
    "Svalbard and Jan Mayen",
    "Sweden",
    "Switzerland",
    "Syrian Arab Republic",
    "Taiwan (Province of China)",
    "Tajikistan",
    "Tanzania, United Republic of",
    "Thailand",
    "Timor-Leste",
    "Togo",
    "Tokelau",
    "Tonga",
    "Trinidad and Tobago",
    "Tunisia",
    "Turkey",
    "Turkmenistan",
    "Turks and Caicos Islands (the)",
    "Tuvalu",
    "Uganda",
    "Ukraine",
    "United Arab Emirates (the)",
    "United Kingdom of Great Britain and Northern Ireland (the)",
    "United States Minor Outlying Islands (the)",
    "United States of America (the)",
    "Uruguay",
    "Uzbekistan",
    "Vanuatu",
    "Venezuela (Bolivarian Republic of)",
    "Viet Nam",
    "Virgin Islands (British)",
    "Virgin Islands (U.S.)",
    "Wallis and Futuna",
    "Western Sahara",
    "Yemen",
    "Zambia",
    "Zimbabwe"
];

?>