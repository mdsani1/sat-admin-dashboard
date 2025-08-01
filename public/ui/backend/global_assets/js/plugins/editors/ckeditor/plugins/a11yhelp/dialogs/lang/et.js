﻿/*
 Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
*/
CKEDITOR.plugins.setLang("a11yhelp", "et", {
  title: "Hõlbustuste kasutamise juhised",
  contents: "Abi sisu. Selle dialoogi sulgemiseks vajuta ESC klahvi.",
  legend: [
    {
      name: "Üldine",
      items: [
        {
          name: "Redaktori tööriistariba",
          legend:
            "Tööriistaribale navigeerimiseks vajuta ${toolbarFocus}. Järgmisele või eelmisele tööriistagrupile liikumiseks vajuta TAB või SHIFT+TAB. Järgmisele või eelmisele tööriistaribale liikumiseks vajuta PAREMALE NOOLT või VASAKULE NOOLT. Vajuta TÜHIKUT või ENTERIT, et tööriistariba nupp aktiveerida.",
        },
        {
          name: "Redaktori dialoog",
          legend:
            "Dialoogi sees vajuta TAB, et liikuda järgmisele dialoogi elemendile, SHIFT+TAB, et liikuda tagasi, vajuta ENTER dialoogi kinnitamiseks, ESC dialoogi sulgemiseks. Kui dialoogil on mitu kaarti/sakki, pääseb kaartide nimekirjale ligi ALT+F10 klahvidega või TABi kasutades. Kui kaartide nimekiri on fookuses, saab järgmisele ja eelmisele kaardile vastavalt PAREMALE ja VASAKULE NOOLTEGA.",
        },
        {
          name: "Redaktori kontekstimenüü",
          legend:
            "Vajuta ${contextMenu} või RAKENDUSE KLAHVI, et avada kontekstimenüü. Siis saad liikuda järgmisele reale TAB klahvi või ALLA NOOLEGA. Employeelmisele valikule saab liikuda SHIFT+TAB klahvidega või ÜLES NOOLEGA. Kirje valimiseks vajuta TÜHIK või ENTER. Alamenüü saab valida kui alammenüü kirje on aktiivne ja valida kas TÜHIK, ENTER või PAREMALE NOOL. Ülemisse menüüsse tagasi saab ESC klahvi või VASAKULE NOOLEGA. Menüü saab sulgeda ESC klahviga.",
        },
        {
          name: "Redaktori loetelu kast",
          legend:
            "Loetelu kasti sees saab järgmisele reale liikuda TAB klahvi või ALLANOOLEGA. Employeelmisele reale saab liikuda SHIFT+TAB klahvide või ÜLESNOOLEGA. Kirje valimiseks vajuta TÜHIKUT või ENTERIT. Loetelu kasti sulgemiseks vajuta ESC klahvi.",
        },
        {
          name: "Redaktori elementide järjestuse riba",
          legend:
            "Vajuta ${elementsPathFocus} et liikuda asukoha ribal asuvatele elementidele. Järgmise elemendi nupule saab liikuda TAB klahviga või PAREMALE NOOLEGA. Employeelmisele nupule saab liikuda SHIFT+TAB klahvi või VASAKULE NOOLEGA. Vajuta TÜHIK või ENTER, et valida redaktoris vastav element.",
        },
      ],
    },
    {
      name: "Käsud",
      items: [
        { name: "Tühistamise käsk", legend: "Vajuta ${undo}" },
        { name: "Uuesti tegemise käsk", legend: "Vajuta ${redo}" },
        { name: "Rasvase käsk", legend: "Vajuta ${bold}" },
        { name: "Kursiivi käsk", legend: "Vajuta ${italic}" },
        { name: "Allajoonimise käsk", legend: "Vajuta ${underline}" },
        { name: "Lingi käsk", legend: "Vajuta ${link}" },
        {
          name: "Tööriistariba peitmise käsk",
          legend: "Vajuta ${toolbarCollapse}",
        },
        {
          name: "Ligipääs eelmisele fookuskohale",
          legend:
            "Vajuta ${accessPreviousSpace}, et pääseda ligi lähimale liigipääsematule fookuskohale enne kursorit, näiteks: kahe järjestikuse HR elemendi vahele. Vajuta kombinatsiooni uuesti, et pääseda ligi kaugematele kohtadele.",
        },
        {
          name: "Ligipääs järgmisele fookuskohale",
          legend:
            "Vajuta ${accessNextSpace}, et pääseda ligi lähimale liigipääsematule fookuskohale pärast kursorit, näiteks: kahe järjestikuse HR elemendi vahele. Vajuta kombinatsiooni uuesti, et pääseda ligi kaugematele kohtadele.",
        },
        { name: "Hõlbustuste abi", legend: "Vajuta ${a11yHelp}" },
        {
          name: "Asetamine tavalise tekstina",
          legend: "Vajuta ${pastetext}",
          legendEdge: "Vajuta ${pastetext}, siis ${paste}",
        },
      ],
    },
  ],
  tab: "Tabulaator",
  pause: "Paus",
  capslock: "Tõstulukk",
  escape: "Paoklahv",
  pageUp: "Leht üles",
  pageDown: "Leht alla",
  leftArrow: "Nool vasakule",
  upArrow: "Nool üles",
  rightArrow: "Nool paremale",
  downArrow: "Nool alla",
  insert: "Sisetamine",
  leftWindowKey: "Vasak Windowsi klahv",
  rightWindowKey: "Parem Windowsi klahv",
  selectKey: "Vali klahv",
  numpad0: "Numbriala 0",
  numpad1: "Numbriala 1",
  numpad2: "Numbriala 2",
  numpad3: "Numbriala 3",
  numpad4: "Numbriala 4",
  numpad5: "Numbriala 5",
  numpad6: "Numbriala 6",
  numpad7: "Numbriala 7",
  numpad8: "Numbriala 8",
  numpad9: "Numbriala 9",
  multiply: "Korrutus",
  add: "Pluss",
  subtract: "Miinus",
  decimalPoint: "Koma",
  divide: "Jagamine",
  f1: "F1",
  f2: "F2",
  f3: "F3",
  f4: "F4",
  f5: "F5",
  f6: "F6",
  f7: "F7",
  f8: "F8",
  f9: "F9",
  f10: "F10",
  f11: "F11",
  f12: "F12",
  numLock: "Numbrilukk",
  scrollLock: "Kerimislukk",
  semiColon: "Semikoolon",
  equalSign: "Võrdusmärk",
  comma: "Koma",
  dash: "Sidekriips",
  period: "Punkt",
  forwardSlash: "Kaldkriips",
  graveAccent: "Rõhumärk",
  openBracket: "Algussulg",
  backSlash: "Kurakaldkriips",
  closeBracket: "Lõpusulg",
  singleQuote: "Ülakoma",
});
