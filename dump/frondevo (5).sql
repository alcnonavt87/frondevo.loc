-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 04 2016 г., 09:51
-- Версия сервера: 5.6.17
-- Версия PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `frondevo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `access_list`
--

CREATE TABLE IF NOT EXISTS `access_list` (
  `idUser` int(11) unsigned NOT NULL COMMENT 'Идентификатор менеджера',
  `idPageGroup` int(11) unsigned NOT NULL COMMENT 'Идентификатор группы страниц',
  UNIQUE KEY `UK_access_list` (`idPageGroup`,`idUser`),
  KEY `FK_access_list_user_id` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=2730 COMMENT='Список доступов к группам страниц для менеджеров сайта';

-- --------------------------------------------------------

--
-- Структура таблицы `claims`
--

CREATE TABLE IF NOT EXISTS `claims` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата поступления',
  `tel` varchar(50) NOT NULL COMMENT 'Телефон',
  `email` varchar(100) DEFAULT NULL COMMENT 'Email',
  `status` tinyint(1) unsigned NOT NULL COMMENT 'Статус 1-обработано/0-не обработано',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='База заявок' AUTO_INCREMENT=265 ;

--
-- Дамп данных таблицы `claims`
--

INSERT INTO `claims` (`id`, `date`, `tel`, `email`, `status`) VALUES
(253, '2016-04-29 13:36:32', '+380967794930', 'krekotenko@gmail.com', 0),
(254, '2016-04-29 13:37:01', '+380967794930', 'krekotenko@gmail.com', 0),
(255, '2016-04-29 16:44:11', '+380967794930', 'krekotenko@gmail.com', 0),
(256, '2016-05-03 07:22:50', '+380967794930', 'krekotenko@gmail.com', 0),
(257, '2016-05-03 07:49:04', '+380967794930', 'krekotenko@gmail.com', 0),
(258, '2016-05-03 07:49:54', '+380967794930', 'krekotenko@gmail.com', 0),
(259, '2016-05-03 07:54:00', '+380967794930', 'krekotenko@gmail.com', 0),
(260, '2016-05-03 08:02:32', '+380967794930', 'krekotenko@gmail.com', 0),
(261, '2016-05-03 08:14:18', '+380967794930', 'krekotenko@gmail.com', 0),
(262, '2016-05-03 08:16:22', '+380967794930', 'krekotenko@gmail.com', 0),
(263, '2016-05-03 08:19:12', '+380967794930', 'sadf@gmail.com', 0),
(264, '2016-05-03 08:20:39', '+380967794930', 'sadf@gmail.com', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `claims_content`
--

CREATE TABLE IF NOT EXISTS `claims_content` (
  `idClaims` int(3) unsigned NOT NULL COMMENT 'Id модуля',
  `lang` varchar(2) NOT NULL COMMENT 'Язык',
  `name` varchar(100) NOT NULL COMMENT 'Название компании',
  `contact` varchar(100) DEFAULT NULL COMMENT 'Контактное лицо',
  `desc` text COMMENT 'Комментарий',
  UNIQUE KEY `idClaims` (`idClaims`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='База заявок (контент)';

--
-- Дамп данных таблицы `claims_content`
--

INSERT INTO `claims_content` (`idClaims`, `lang`, `name`, `contact`, `desc`) VALUES
(253, '', 'Frondevo', 'Anatoliy', 'this is my first site'),
(254, '', 'Frondevo', 'Anatoliy', 'dsafsaf'),
(255, '', 'Frondevo', 'Anatoliy', 'dasfasfasf'),
(256, '', 'Frondevo', 'Anatoliy', 'sdfgfdsg'),
(257, '', 'Frondevo', 'adfasfasf', 'sdafasfas'),
(258, '', 'Frondevo', 'adfasfasf', 'dsdfgdf'),
(259, '', 'Frondevo', 'adfasfasf', 'dsdfgdf'),
(260, '', 'Frondevo', 'adfasfasf', 'dsdfgdf'),
(261, '', 'Frondevo', 'adfasfasf', 'dsdfgdf'),
(262, '', 'Frondevo', 'adfasfasf', 'dsdfgdf'),
(263, '', 'adsfasf', 'anatoliy', 'asdfasfafa'),
(264, '', 'adsfasf', 'anatoliy', 'afdasfasf');

-- --------------------------------------------------------

--
-- Структура таблицы `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `pageId` int(11) unsigned NOT NULL COMMENT 'Идентификатор страницы',
  `lang` varchar(2) NOT NULL COMMENT 'Язык контента страницы',
  `pTitle` varchar(255) NOT NULL DEFAULT '' COMMENT 'Заголовок страницы',
  `pUrl` varchar(255) NOT NULL,
  `pDescription` varchar(300) NOT NULL DEFAULT '' COMMENT 'Описание страницы',
  `pKeyWords` varchar(255) NOT NULL DEFAULT '' COMMENT 'Ключевые члова (теги)',
  `pH1` varchar(255) NOT NULL COMMENT 'Заголовок в тексте, пункт в меню навигации',
  `pMenuName` varchar(255) NOT NULL DEFAULT '' COMMENT 'Название пункта меню',
  `pBreadCrumbs` varchar(255) NOT NULL DEFAULT '' COMMENT 'Текст для хлебных крошек',
  `pContent` text NOT NULL COMMENT 'Содержимое страницы',
  `imageTitle` varchar(255) NOT NULL,
  `section1` text NOT NULL COMMENT 'Секция1',
  `section2` text NOT NULL COMMENT 'Секция2',
  `section3` text NOT NULL COMMENT 'Секция3',
  `section4` text NOT NULL COMMENT 'Секция4',
  `section5` text NOT NULL COMMENT 'Секция5',
  `indexTextButton` varchar(50) NOT NULL,
  `indexAltName` varchar(255) NOT NULL,
  `sbkdescription` varchar(255) NOT NULL COMMENT 'Описания работ',
  `textforbackground` varchar(50) NOT NULL COMMENT 'Текст background',
  `sbkworkstext` varchar(255) NOT NULL COMMENT 'Title small ',
  `sbksmalltitle3` varchar(255) NOT NULL COMMENT 'Title small',
  `sbktitlestep1` varchar(255) NOT NULL COMMENT 'Title шага',
  `sbkdeskstep1` varchar(255) NOT NULL COMMENT 'Описание шага',
  `sbktitlestep2` varchar(50) NOT NULL COMMENT 'Title шага',
  `sbkdeskstep2` varchar(255) NOT NULL COMMENT 'Описание шага',
  `sbktitlestep3` varchar(255) NOT NULL COMMENT 'Title шага',
  `sbkdeskstep3` varchar(255) NOT NULL COMMENT 'Описание шага',
  `sbktitlestep4` varchar(255) NOT NULL COMMENT 'Title шага',
  `sbkdeskstep4` varchar(255) NOT NULL COMMENT 'Описание шага',
  `sbktitlestep5` varchar(255) NOT NULL COMMENT 'Title шага',
  `sbkdeskstep5` varchar(255) NOT NULL COMMENT 'Описание шага',
  `sbktitlestep6` varchar(255) NOT NULL COMMENT 'Title шага',
  `sbkdeskstep6` varchar(255) NOT NULL COMMENT 'Описание шага',
  `sbktitlestep7` varchar(255) NOT NULL COMMENT 'Title шага',
  `sbkdeskstep7` varchar(255) NOT NULL COMMENT 'Описание шага',
  `sbksmalltitle` varchar(255) NOT NULL COMMENT 'Title small',
  `sbkstagetitle1` varchar(255) NOT NULL COMMENT 'Title этапа',
  `sbkstagetitle2` varchar(255) NOT NULL COMMENT 'Title этапа',
  `sbkstagetitle3` varchar(255) NOT NULL COMMENT 'Title этапа',
  `sbkstagetitle4` varchar(255) NOT NULL COMMENT 'Title этапа',
  `sbkstagetitle5` varchar(255) NOT NULL COMMENT 'Title этапа',
  `sbkstagetitle6` varchar(255) NOT NULL COMMENT 'Title этапа',
  `imagebgsbkTitle` varchar(100) NOT NULL COMMENT 'Изображение для background - заголовок',
  `imagebgsbklpTitle` varchar(100) NOT NULL COMMENT 'Изображение для background(laptop 1487x736) - заголовок',
  `imagebgsbkmbTitle` varchar(100) NOT NULL COMMENT 'Изображение для background(mobile 970x480) - заголовок',
  `sbkdeskwork1` varchar(255) NOT NULL COMMENT 'Описание работы 1',
  `sbkimgwork1Title` varchar(100) NOT NULL COMMENT 'Изображение для работы №1 - заголовок',
  `sbkdeskwork2` varchar(255) NOT NULL COMMENT 'Описание работы 2',
  `sbkimgwork2Title` varchar(100) NOT NULL COMMENT 'Изображение для работы №2 - заголовок',
  `sbkdeskwork3` varchar(255) NOT NULL COMMENT 'Описание работы 3',
  `sbkimgwork3Title` varchar(100) NOT NULL COMMENT 'Изображение для работы №3 - заголовок',
  `sbkdeskwork4` varchar(255) NOT NULL COMMENT 'Описание работы 4',
  `sbkimgwork4Title` varchar(100) NOT NULL COMMENT 'Изображение для работы №4 - заголовок',
  `sbkdeskwork5` varchar(255) NOT NULL COMMENT 'Описание работы 5',
  `sbkimgwork5Title` varchar(100) NOT NULL COMMENT 'Изображение для работы №5 - заголовок',
  `sbkdeskwork6` varchar(255) NOT NULL COMMENT 'Описание работы 6',
  `sbkimgwork6Title` varchar(100) NOT NULL COMMENT 'Изображение для работы №6 - заголовок',
  `sbkdeskwork7` varchar(255) NOT NULL COMMENT 'Описание работы 7',
  `sbkimgwork7Title` varchar(100) NOT NULL COMMENT 'Изображение для работы №7 - заголовок',
  `snVkontakte` varchar(50) NOT NULL COMMENT 'Вконтакте',
  `snFacebook` varchar(50) NOT NULL COMMENT 'Фэйсбук',
  `snTwitter` varchar(50) NOT NULL COMMENT 'Твиттер',
  `snBahance` varchar(50) NOT NULL COMMENT 'Bahance',
  `snInstagram` varchar(50) NOT NULL COMMENT 'Instagram',
  `snBall` varchar(50) NOT NULL COMMENT 'Ball',
  `snPinterest` varchar(50) NOT NULL COMMENT 'Pinterest',
  PRIMARY KEY (`lang`,`pageId`),
  UNIQUE KEY `UK_content` (`lang`,`pageId`),
  KEY `FK_content_pages_id` (`pageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=585 COMMENT='Содержимое страниц на разных языках';

--
-- Дамп данных таблицы `content`
--

INSERT INTO `content` (`pageId`, `lang`, `pTitle`, `pUrl`, `pDescription`, `pKeyWords`, `pH1`, `pMenuName`, `pBreadCrumbs`, `pContent`, `imageTitle`, `section1`, `section2`, `section3`, `section4`, `section5`, `indexTextButton`, `indexAltName`, `sbkdescription`, `textforbackground`, `sbkworkstext`, `sbksmalltitle3`, `sbktitlestep1`, `sbkdeskstep1`, `sbktitlestep2`, `sbkdeskstep2`, `sbktitlestep3`, `sbkdeskstep3`, `sbktitlestep4`, `sbkdeskstep4`, `sbktitlestep5`, `sbkdeskstep5`, `sbktitlestep6`, `sbkdeskstep6`, `sbktitlestep7`, `sbkdeskstep7`, `sbksmalltitle`, `sbkstagetitle1`, `sbkstagetitle2`, `sbkstagetitle3`, `sbkstagetitle4`, `sbkstagetitle5`, `sbkstagetitle6`, `imagebgsbkTitle`, `imagebgsbklpTitle`, `imagebgsbkmbTitle`, `sbkdeskwork1`, `sbkimgwork1Title`, `sbkdeskwork2`, `sbkimgwork2Title`, `sbkdeskwork3`, `sbkimgwork3Title`, `sbkdeskwork4`, `sbkimgwork4Title`, `sbkdeskwork5`, `sbkimgwork5Title`, `sbkdeskwork6`, `sbkimgwork6Title`, `sbkdeskwork7`, `sbkimgwork7Title`, `snVkontakte`, `snFacebook`, `snTwitter`, `snBahance`, `snInstagram`, `snBall`, `snPinterest`) VALUES
(1, 'en', 'Main', 'index', 'Main', 'Main', 'Internet agency', 'Main', 'Main', '<p>Main</p>', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 'en', 'Sites by keys', 'siten', 'Sites by keys', '', 'Sites by keys', 'Sites by keys', '', '<p>Sites by keys</p>', '', '<p>Sites by keys-section 1</p>', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 'en', 'Portfolio', 'portfolio', 'Portfolio', '', 'Portfolio', 'Portfolio', '', '', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 'en', 'Commercial', 'com', 'Commercial', '', 'Commercial', 'Commercial', '', '<p>Commercial</p>', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 'en', 'Contacts', 'cont', 'Contacts', '', 'Contacts', 'Contacts', '', '<p>Contacts</p>', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Vkontakte', 'Facebook', 'Twitter', '', '', '', ''),
(6, 'en', 'Landing Page', 'landing-page', 'Landing Page', 'Landing Page', 'Landing Page', 'Landing Page', 'Landing Page', '<p>Landing Page</p>', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(1, 'ru', 'Интернет&nbsp;&mdash; агенство', 'index', 'Главная', '', 'Интернет&nbsp;&mdash; агенство', 'Главная', '', 'Комплексный подход по&nbsp;разработке эффективных решений <br />\nдля амбициозных интернет&nbsp;&mdash; проектов', '', '', '', '', '', '', 'разработка сайтов', 'Интернет&nbsp;&mdash; агенство', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 'ru', '&laquo;Сайты&nbsp;&mdash; это чудо&raquo;', 'siteru', '&laquo;Сайты под ключ&raquo;', '', '&laquo;Сайты&nbsp;&mdash; под ключ&raquo;', 'Сайты под ключ', '', '<h1>\r\n	<span><span>разрабатываем</span><span>сайты, которые</span></span><span>\r\n		<span class="ru-lt-1">у</span>\r\n		<span class="ru-lt-2">б</span>\r\n		<span class="ru-lt-3">е</span>\r\n		<span class="ru-lt-4">ж</span>\r\n		<span class="ru-lt-5">д</span>\r\n		<span class="ru-lt-6">а</span>\r\n		<span class="ru-lt-7">ю</span>\r\n		<span class="ru-lt-8">т</span>\r\n	</span>\r\n	<span>\r\n		<span>приобретать ваши продукты</span>\r\n	</span>\r\n</h1>', '', '<div class="choose__reason">\r\n\r\n        <!-- layout -->\r\n        <div class="layout">\r\n\r\n            <!-- choose  reason t1 -->\r\n            <div class="choose__reason_t1">\r\n                <span>причины,<br> по которым</span>\r\n                <span>стоит<br> обратиться именно к нам</span>\r\n            </div>\r\n            <!--/choose  reason t1 -->\r\n\r\n\r\n            <!-- choose  reason t2 -->\r\n\r\n            <div class="choose__reason_t2 frame">\r\n                <input type="radio" name="reason-list" id="input-reason-1" checked="checked">\r\n                <input type="radio" name="reason-list" id="input-reason-2">\r\n                <input type="radio" name="reason-list" id="input-reason-3">\r\n                <input type="radio" name="reason-list" id="input-reason-4">\r\n                <input type="radio" name="reason-list" id="input-reason-5">\r\n                <ul>\r\n                    <li>\r\n                        <div>\r\n                                        <span>\r\n\r\n                                            <!-- (i + 1) -->\r\n                                            <span data-step=''1''>\r\n                                                <span>Бизнес-мышление</span>\r\n                                            </span>\r\n                                            <!--/(i + 1) -->\r\n\r\n                                        </span>\r\n\r\n                            <div>\r\n                                <p class="white">Сначала думаем как будем продавать. Потом — как это будет выглядеть и\r\n                                    работать.</p>\r\n\r\n                                <p>Используя хорошее понимание бизнеса клиента, его рыночной ниши и целевой аудитории,\r\n                                    можно обеспечить существенное конкурентное преимущество любому бизнес-проекту.</p>\r\n\r\n                                <p>Поэтому мы особое внимание уделяем маркетинговому исследованию и подготовке\r\n                                    маркетинговой стратегии до начала разработки сайта.</p>\r\n\r\n                                <!-- choose  reason button wrap -->\r\n                                <label for="input-reason-2" class="choose__reason-button-wrap">\r\n                                    <span>1</span>\r\n\r\n                                    <div class="choose__reason-next"></div>\r\n                                </label>\r\n                                <!--/choose  reason button wrap -->\r\n\r\n                            </div>\r\n                        </div>\r\n                    </li>\r\n                    <li>\r\n                        <div>\r\n                                        <span>\r\n\r\n                                            <!-- (i + 1) -->\r\n                                            <span data-step=''2''>\r\n                                                <span>Больше, чем разработка сайта</span>\r\n                                            </span>\r\n                                            <!--/(i + 1) -->\r\n\r\n                                        </span>\r\n\r\n                            <div>\r\n                                <p>Сможем помочь понять особенности интернет-рынка и его тенденции, разработать\r\n                                    оптимальный план развития проекта с учетом выбранной маркетинговой стратегии и\r\n                                    имеющихся ресурсов.</p>\r\n\r\n                                <!-- choose  reason button wrap -->\r\n                                <label for="input-reason-3" class="choose__reason-button-wrap">\r\n                                    <span>2</span>\r\n\r\n                                    <div class="choose__reason-next"></div>\r\n                                </label>\r\n                                <!--/choose  reason button wrap -->\r\n\r\n                            </div>\r\n                        </div>\r\n                    </li>\r\n                    <li>\r\n                        <div>\r\n                                        <span>\r\n\r\n                                            <!-- (i + 1) -->\r\n                                            <span data-step=''3''>\r\n                                                <span>Высокая эффективность </span>\r\n                                            </span>\r\n                                            <!--/(i + 1) -->\r\n\r\n                                        </span>\r\n\r\n                            <div>\r\n                                <p>Мы не используем шаблонные решения. Наши проекты разрабатываются индивидуально под\r\n                                    задачи клиента. Это позволяет создавать максимально эффективные продукты.</p>\r\n\r\n                                <!-- choose  reason button wrap -->\r\n                                <label for="input-reason-4" class="choose__reason-button-wrap">\r\n                                    <span>3</span>\r\n\r\n                                    <div class="choose__reason-next"></div>\r\n                                </label>\r\n                                <!--/choose  reason button wrap -->\r\n\r\n                            </div>\r\n                        </div>\r\n                    </li>\r\n                    <li>\r\n                        <div>\r\n                                        <span>\r\n\r\n                                            <!-- (i + 1) -->\r\n                                            <span data-step=''4''>\r\n                                                <span>На шаг впереди</span>\r\n                                            </span>\r\n                                            <!--/(i + 1) -->\r\n\r\n                                        </span>\r\n\r\n                            <div>\r\n                                <p>Применение новейших технологий веб-разработки, современных трендов в дизайне,\r\n                                    эффективных методик рекламы позволяет нашим клиентам быть на шаг впереди\r\n                                    конкурентов.</p>\r\n\r\n                                <!-- choose  reason button wrap -->\r\n                                <label for="input-reason-5" class="choose__reason-button-wrap">\r\n                                    <span>4</span>\r\n\r\n                                    <div class="choose__reason-next"></div>\r\n                                </label>\r\n                                <!--/choose  reason button wrap -->\r\n\r\n                            </div>\r\n                        </div>\r\n                    </li>\r\n                    <li>\r\n                        <div>\r\n                                        <span>\r\n\r\n                                            <!-- (i + 1) -->\r\n                                            <span data-step=''5''>\r\n                                                <span>знание закулисья</span>\r\n                                            </span>\r\n                                            <!--/(i + 1) -->\r\n\r\n                                        </span>\r\n\r\n                            <div>\r\n                                <p>У нас есть опыт создания и развития собственных интернет проектов. Это бесценные\r\n                                    знания, которые не получить просто разрабатывая сайты на аутсорсе.</p>\r\n\r\n                                <!-- choose  reason button wrap -->\r\n                                <label for="input-reason-1" class="choose__reason-button-wrap">\r\n                                    <span>5</span>\r\n\r\n                                    <div class="choose__reason-next"></div>\r\n                                </label>\r\n                                <!--/choose  reason button wrap -->\r\n\r\n                            </div>\r\n                        </div>\r\n                    </li>\r\n                </ul>\r\n            </div>\r\n            <!--/choose  reason t2 -->\r\n\r\n\r\n            <!-- choose  reason t3 -->\r\n            <div class="choose__reason_t3">\r\n                <span>разделяем точку зрения, что<br></span>\r\n                <span>пренебрежение качеством сегодня, <br>приводит к потере клиентов завтра.</span>\r\n            </div>\r\n            <!--/choose  reason t3 -->\r\n\r\n        </div>\r\n        <!--/layout -->\r\n\r\n    </div>\r\n    <!--/choose  reason -->', '<span>качество сайта измеряется</span>достижением поставленных бизнес-целей', '<span>Успех коммерческого сайта<br> — это результат закалки</span>несколькими итерациями улучшений', 'в среднем разработка сайта длится 3 месяца <br>и задействует 8 специалистов', '<span>что получает</span> наш клиент', '0', '0', 'Современные интернет-решения с высоким уровнем конверсий<br> и мощной внутренней SEO оптимизацией', 'Сайты', 'примеры наших работ', 'наш подход к разработке сайтов', 'обсуждение', 'Каким вы видите свой будущий сайт. <br>Согласование целей и задач, общего <br>порядка\r\n                            предстоящих работ.', 'исследование', 'Знакомство с вашей отраслью и вашим продуктом. Изучение конъюктуры рынка. Определение и\r\n                            детальное изучение целевой аудитории. Разбор сильных и слабых сторон вашего предложения.', 'стратегия', 'Подготовка маркетинговой стратегии и <br>этапов развития проекта с учетом текущей <br>конкуренции,\r\n                            динамики развития рынка и имеющихся у вас ресурсов.', 'проектирование', 'UI/UX дизайн. Разработка согласно целям проекта. Корректировка по результатам\r\n                                аналитики.', 'разработка', 'Копирайтинг. Дизайн. Техническая часть. Наполнение контентом. Тестирование.', 'маркетинг', 'Разработка структуры сайта и прототипирование типвых страниц полагаясь на полученные\r\n                                исследования.', 'аналитика', 'Разработка структуры сайта и прототипирование типвых страниц полагаясь на полученные\r\n                                исследования.', 'результаты каждого этапа демонстрируются и обсуждаются с клиентом', 'Исследования', 'Проектирование', 'Дизайн', 'Разработка', 'Контент', 'Поддержка', '', '', '', 'Это работа 1', '', 'Это работа 2', '', 'Это работа 3', '', 'Это работа 4', '', 'Это работа 5', '', 'Это работа 6', '', 'Это работа 7', '', '', '', '', '', '', '', ''),
(3, 'ru', 'Портфолио&nbsp;&mdash; front end разработок', 'portfolio', 'Портфол', '', 'Портфолио front end разработок', 'Портфолио', '', '', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 'ru', 'Комерческое', 'commercial', 'Комерческое', '', 'Комерческое', 'Комерческое', '', '<p>Комерческое</p>', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 'ru', 'Контакты', 'cont', 'Контакты', '', 'Контакты', 'Контакты', '', '<p>Контакты</p>', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'https://vk.com/', 'https://www.facebook.com/', 'https://twitter.com/?lang=ru', '', 'Инстаграм', '', ''),
(6, 'ru', 'Посадочная страница', 'landing-page', 'Посадочная страница', '', 'Посадочная страница', 'Посадочная страница', '', '<p>Посадочная страница</p>', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(1, 'ua', 'Головна', 'index', 'Головна', 'Головна', 'Інтернет-агенство', 'Головна', 'Головна', '<p>Головна</p>', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 'ua', 'Сайти під ключ', 'siteua', 'Сайти під ключ', 'Сайти під ключ', 'Сайти під ключ', 'Сайти під ключ', 'Сайти під ключ', '<p>Сайти під ключ</p>', '', '<div>\r\n<div class="choose__reason"><br /><br /> <!-- layout --><br />\r\n<div class="layout"><br /><br /><br />\r\n<div class="choose__reason_t1"><br /> причины,<br /> по которым<br /> стоит<br /> обратиться именно к нам</div>\r\n<br /> <!--/choose reason t1 --><br /><br /><br /> <!-- choose reason t2 --><br /><br />\r\n<div class="choose__reason_t2 frame"><br /> <input id="input-reason-1" checked="checked" name="reason-list" type="radio" /><br /> <input id="input-reason-2" name="reason-list" type="radio" /><br /> <input id="input-reason-3" name="reason-list" type="radio" /><br /> <input id="input-reason-4" name="reason-list" type="radio" /><br /> <input id="input-reason-5" name="reason-list" type="radio" /><br /><br />\r\n<ul>\r\n<ul>\r\n<li><br />\r\n<div><br /> <br /><br /> <!-- (i + 1) --><br /> <span data-step="1"><br /> Бизнес-мышление<br /> </span><br /> <!--/(i + 1) --><br /><br /> <br />\r\n<div><br />\r\n<p class="white">Сначала думаем как будем продавать. Потом &mdash; как это будет выглядеть и работать.</p>\r\n<br />\r\n<p>Используя хорошее понимание бизнеса клиента, его рыночной ниши и целевой аудитории, можно обеспечить существенное конкурентное преимущество любому бизнес-проекту.</p>\r\n<br />\r\n<p>Поэтому мы особое внимание уделяем маркетинговому исследованию и подготовке маркетинговой стратегии до начала разработки сайта.</p>\r\n<br /><br /> <!-- choose reason button wrap --><br /> <label class="choose__reason-button-wrap" for="input-reason-2"><label class="choose__reason-button-wrap" for="input-reason-2"><br /> 1<br /></label></label>\r\n<div class="choose__reason-next">&nbsp;</div>\r\n<label class="choose__reason-button-wrap" for="input-reason-2"><br /> </label><br /> <!--/choose reason button wrap --><br /><br /></div>\r\n</div>\r\n</li>\r\n</ul>\r\n</ul>\r\n<br />\r\n<ul>\r\n<ul>\r\n<li><br />\r\n<div><br /> <br /><br /> <!-- (i + 1) --><br /> <span data-step="2"><br /> Больше, чем разработка сайта<br /> </span><br /> <!--/(i + 1) --><br /><br /> <br />\r\n<div><br />\r\n<p>Сможем помочь понять особенности интернет-рынка и его тенденции, разработать оптимальный план развития проекта с учетом выбранной маркетинговой стратегии и имеющихся ресурсов.</p>\r\n<br /><br /> <!-- choose reason button wrap --><br /> <label class="choose__reason-button-wrap" for="input-reason-3"><label class="choose__reason-button-wrap" for="input-reason-3"><br /> 2<br /></label></label>\r\n<div class="choose__reason-next">&nbsp;</div>\r\n<label class="choose__reason-button-wrap" for="input-reason-3"><br /> </label><br /> <!--/choose reason button wrap --><br /><br /></div>\r\n</div>\r\n</li>\r\n</ul>\r\n</ul>\r\n<br />\r\n<ul>\r\n<ul>\r\n<li><br />\r\n<div><br /> <br /><br /> <!-- (i + 1) --><br /> <span data-step="3"><br /> Высокая эффективность <br /> </span><br /> <!--/(i + 1) --><br /><br /> <br />\r\n<div><br />\r\n<p>Мы не используем шаблонные решения. Наши проекты разрабатываются индивидуально под задачи клиента. Это позволяет создавать максимально эффективные продукты.</p>\r\n<br /><br /> <!-- choose reason button wrap --><br /> <label class="choose__reason-button-wrap" for="input-reason-4"><label class="choose__reason-button-wrap" for="input-reason-4"><br /> 3<br /></label></label>\r\n<div class="choose__reason-next">&nbsp;</div>\r\n<label class="choose__reason-button-wrap" for="input-reason-4"><br /> </label><br /> <!--/choose reason button wrap --><br /><br /></div>\r\n</div>\r\n</li>\r\n</ul>\r\n</ul>\r\n<br />\r\n<ul>\r\n<ul>\r\n<li><br />\r\n<div><br /> <br /><br /> <!-- (i + 1) --><br /> <span data-step="4"><br /> На шаг впереди<br /> </span><br /> <!--/(i + 1) --><br /><br /> <br />\r\n<div><br />\r\n<p>Применение новейших технологий веб-разработки, современных трендов в дизайне, эффективных методик рекламы позволяет нашим клиентам быть на шаг впереди конкурентов.</p>\r\n<br /><br /> <!-- choose reason button wrap --><br /> <label class="choose__reason-button-wrap" for="input-reason-5"><label class="choose__reason-button-wrap" for="input-reason-5"><br /> 4<br /></label></label>\r\n<div class="choose__reason-next">&nbsp;</div>\r\n<label class="choose__reason-button-wrap" for="input-reason-5"><br /> </label><br /> <!--/choose reason button wrap --><br /><br /></div>\r\n</div>\r\n</li>\r\n</ul>\r\n</ul>\r\n<br />\r\n<ul>\r\n<ul>\r\n<li><br />\r\n<div><br /> <br /><br /> <!-- (i + 1) --><br /> <span data-step="5"><br /> знание закулисья<br /> </span><br /> <!--/(i + 1) --><br /><br /> <br />\r\n<div><br />\r\n<p>У нас есть опыт создания и развития собственных интернет проектов. Это бесценные знания, которые не получить просто разрабатывая сайты на аутсорсе.</p>\r\n<br /><br /> <!-- choose reason button wrap --><br /> <label class="choose__reason-button-wrap" for="input-reason-1"><label class="choose__reason-button-wrap" for="input-reason-1"><br /> 5<br /></label></label>\r\n<div class="choose__reason-next">&nbsp;</div>\r\n<label class="choose__reason-button-wrap" for="input-reason-1"><br /> </label><br /> <!--/choose reason button wrap --><br /><br /></div>\r\n</div>\r\n</li>\r\n</ul>\r\n</ul>\r\n<br /><br /></div>\r\n<br /> <!--/choose reason t2 --><br /><br /><br /> <!-- choose reason t3 --><br />\r\n<div class="choose__reason_t3"><br /> разделяем точку зрения, что<br /><br /> пренебрежение качеством сегодня, <br />приводит к потере клиентов завтра.</div>\r\n<br /> <!--/choose reason t3 --><br /><br /></div>\r\n<br /> <!--/layout --><br /><br /></div>\r\n</div>\r\n<div>&nbsp;</div>', '<div class="choose__reason"><!-- layout -->\r\n<div class="layout"><!-- choose  reason t1 -->\r\n<div class="choose__reason_t1">причины,<br /> по которым стоит<br /> обратиться именно к нам</div>\r\n<!--/choose  reason t1 --> <!-- choose  reason t2 -->\r\n<div class="choose__reason_t2 frame"><input id="input-reason-1" checked="checked" name="reason-list" type="radio" /> <input id="input-reason-2" name="reason-list" type="radio" /> <input id="input-reason-3" name="reason-list" type="radio" /> <input id="input-reason-4" name="reason-list" type="radio" /> <input id="input-reason-5" name="reason-list" type="radio" />\r\n<ul>\r\n<li>\r\n<div><!-- (i + 1) --> <span data-step="1"> Бизнес-мышление </span> <!--/(i + 1) -->\r\n<div>\r\n<p class="white">Сначала думаем как будем продавать. Потом &mdash; как это будет выглядеть и работать.</p>\r\n<p>Используя хорошее понимание бизнеса клиента, его рыночной ниши и целевой аудитории, можно обеспечить существенное конкурентное преимущество любому бизнес-проекту.</p>\r\n<p>Поэтому мы особое внимание уделяем маркетинговому исследованию и подготовке маркетинговой стратегии до начала разработки сайта.</p>\r\n<!-- choose  reason button wrap --> <label class="choose__reason-button-wrap" for="input-reason-2"><label class="choose__reason-button-wrap" for="input-reason-2">1</label></label>\r\n<div class="choose__reason-next">&nbsp;</div>\r\n<!--/choose  reason button wrap --></div>\r\n</div>\r\n</li>\r\n<li>\r\n<div><!-- (i + 1) --> <span data-step="2"> Больше, чем разработка сайта </span> <!--/(i + 1) -->\r\n<div>\r\n<p>Сможем помочь понять особенности интернет-рынка и его тенденции, разработать оптимальный план развития проекта с учетом выбранной маркетинговой стратегии и имеющихся ресурсов.</p>\r\n<!-- choose  reason button wrap --> <label class="choose__reason-button-wrap" for="input-reason-3"><label class="choose__reason-button-wrap" for="input-reason-3">2</label></label>\r\n<div class="choose__reason-next">&nbsp;</div>\r\n<!--/choose  reason button wrap --></div>\r\n</div>\r\n</li>\r\n<li>\r\n<div><!-- (i + 1) --> <span data-step="3"> Высокая эффективность </span> <!--/(i + 1) -->\r\n<div>\r\n<p>Мы не используем шаблонные решения. Наши проекты разрабатываются индивидуально под задачи клиента. Это позволяет создавать максимально эффективные продукты.</p>\r\n<!-- choose  reason button wrap --> <label class="choose__reason-button-wrap" for="input-reason-4"><label class="choose__reason-button-wrap" for="input-reason-4">3</label></label>\r\n<div class="choose__reason-next">&nbsp;</div>\r\n<!--/choose  reason button wrap --></div>\r\n</div>\r\n</li>\r\n<li>\r\n<div><!-- (i + 1) --> <span data-step="4"> На шаг впереди </span> <!--/(i + 1) -->\r\n<div>\r\n<p>Применение новейших технологий веб-разработки, современных трендов в дизайне, эффективных методик рекламы позволяет нашим клиентам быть на шаг впереди конкурентов.</p>\r\n<!-- choose  reason button wrap --> <label class="choose__reason-button-wrap" for="input-reason-5"><label class="choose__reason-button-wrap" for="input-reason-5">4</label></label>\r\n<div class="choose__reason-next">&nbsp;</div>\r\n<!--/choose  reason button wrap --></div>\r\n</div>\r\n</li>\r\n<li>\r\n<div><!-- (i + 1) --> <span data-step="5"> знание закулисья </span> <!--/(i + 1) -->\r\n<div>\r\n<p>У нас есть опыт создания и развития собственных интернет проектов. Это бесценные знания, которые не получить просто разрабатывая сайты на аутсорсе.</p>\r\n<!-- choose  reason button wrap --> <label class="choose__reason-button-wrap" for="input-reason-1"><label class="choose__reason-button-wrap" for="input-reason-1">5</label></label>\r\n<div class="choose__reason-next">&nbsp;</div>\r\n<!--/choose  reason button wrap --></div>\r\n</div>\r\n</li>\r\n</ul>\r\n</div>\r\n<!--/choose  reason t2 --> <!-- choose  reason t3 -->\r\n<div class="choose__reason_t3">разделяем точку зрения, что<br /> пренебрежение качеством сегодня, <br />приводит к потере клиентов завтра.</div>\r\n<!--/choose  reason t3 --></div>\r\n<!--/layout --></div>', '<div class="approach"><!-- layout -->\r\n<div class="layout">\r\n<h2>Успех коммерческого сайта<br /> &mdash; это результат закалкинесколькими итерациями улучшений</h2>\r\n<h3>наш подход к разработке сайтов</h3>\r\n<!-- approach  list wrap -->\r\n<div class="approach__list-wrap"><!-- approach  list -->\r\n<div class="approach__list"><!-- approach  item -->\r\n<div class="approach__item">\r\n<h3>обсуждение</h3>\r\n<p>Каким вы видите свой будущий сайт. <br />Согласование целей и задач, общего <br />порядка предстоящих работ.</p>\r\n</div>\r\n<!--/approach  item --> <!-- approach  item -->\r\n<div class="approach__item">\r\n<h3>исследование</h3>\r\n<p>Знакомство с вашей отраслью и вашим продуктом. Изучение конъюктуры рынка. Определение и детальное изучение целевой аудитории. Разбор сильных и слабых сторон вашего предложения.</p>\r\n</div>\r\n<!--/approach  item --> <!-- approach  item -->\r\n<div class="approach__item">\r\n<h3>стратегия</h3>\r\n<p>Подготовка маркетинговой стратегии и <br />этапов развития проекта с учетом текущей <br />конкуренции, динамики развития рынка и имеющихся у вас ресурсов.</p>\r\n</div>\r\n<!--/approach  item --></div>\r\n<!--/approach  list --> <!-- approach  list -->\r\n<div class="approach__list"><!-- layout -->\r\n<div class="layout"><!-- approach  item -->\r\n<div class="approach__item">\r\n<h3>проектирование</h3>\r\n<p>UI/UX дизайн. Разработка согласно целям проекта. Корректировка по результатам аналитики.</p>\r\n</div>\r\n<!--/approach  item --> <!-- approach  item -->\r\n<div class="approach__item">\r\n<h3>разработка</h3>\r\n<p>Копирайтинг. Дизайн. Техническая часть. Наполнение контентом. Тестирование.</p>\r\n</div>\r\n<!--/approach  item --> <!-- approach  item -->\r\n<div class="approach__item">\r\n<h3>маркетинг</h3>\r\n<p>Разработка структуры сайта и прототипирование типвых страниц полагаясь на полученные исследования.</p>\r\n</div>\r\n<!--/approach  item --> <!-- approach  item -->\r\n<div class="approach__item">\r\n<h3>аналитика</h3>\r\n<p>Разработка структуры сайта и прототипирование типвых страниц полагаясь на полученные исследования.</p>\r\n</div>\r\n<!--/approach  item --></div>\r\n<!--/layout --></div>\r\n<!--/approach  list --></div>\r\n<!--/approach  list wrap --></div>\r\n<!--/layout --></div>', '<div id="indicators1" class="stages hor-indicators"><!-- stages  back -->\r\n<div class="stages__back">&nbsp;</div>\r\n<!--/stages  back -->\r\n<div class="stages__back stages__back-2"><img class="hor-ind" src="../frontend/web/markup/img/sites/frondevo.png" alt="Сайты" width="4826" height="612" /></div>\r\n<!-- stages  wrap -->\r\n<div class="stages__wrap">\r\n<h2>в среднем разработка сайта длится 3 месяца <br />и задействует 8 специалистов</h2>\r\n<h3>результаты каждого этапа демонстрируются и обсуждаются с клиентом</h3>\r\n<!-- stages  layout -->\r\n<div class="stages__layout hor-wrapper" data-indicators="indicators1"><!-- stages  scroll -->\r\n<div class="stages__scroll hor-scroller hor-scrollbar hor-snap-mobile"><!-- stages  list -->\r\n<ul class="stages__list"><!-- stages  item -->\r\n<li class="stages__item hor-sizing hor-snap researching">\r\n<h3>Исследования</h3>\r\n<div>\r\n<ul>\r\n<li>определение задач и целей проекта</li>\r\n<li>анализ Вашей бизнес-модели</li>\r\n<li>аудит Вашей отрасли в Интернет</li>\r\n<li>определение и исследование целевой адуитории</li>\r\n<li>аудит Вашего сайта</li>\r\n<li>анализ сайтов конкурентов</li>\r\n<li>разработка перечня маркетинговых рекомендаций для будущего сайта</li>\r\n</ul>\r\n</div>\r\n</li>\r\n<!--/stages  item --> <!-- stages  item -->\r\n<li class="stages__item hor-sizing hor-snap projecting">\r\n<h3>Проектирование</h3>\r\n<div>\r\n<ul>\r\n<li>определение необходимых технических требований</li>\r\n<li>проектирование схем воронок продаж</li>\r\n<li>проектирование схем привлечения трафика</li>\r\n<li>разработка стурктуры сайта</li>\r\n<li>проектирование интерфейсов с учетом множества доступных устройств пользователю</li>\r\n<li>подготовка технических заданий для проектной группы</li>\r\n</ul>\r\n</div>\r\n</li>\r\n<!--/stages  item --> <!-- stages  item -->\r\n<li class="stages__item hor-sizing hor-snap designing">\r\n<h3>Дизайн</h3>\r\n<div>\r\n<ul>\r\n<li>современные графические и интерактивные решения</li>\r\n<li>эмоциональное воздействие на целевую аудиторию</li>\r\n<li>разработка сценариев для интерактивных элементов и анимационных эффектов</li>\r\n<li>применение практик повышения уровня конверсии</li>\r\n<li>использование методик по улучшению степени удобности использования сайтом</li>\r\n</ul>\r\n</div>\r\n</li>\r\n<!--/stages  item --> <!-- stages  item -->\r\n<li class="stages__item hor-sizing hor-snap developing">\r\n<h3>Разработка</h3>\r\n<div>\r\n<ul>\r\n<li>современные технологии веб разработки</li>\r\n<li>индивидуальные решения под Ваши задачи</li>\r\n<li>оптимизация работы операторов сайта</li>\r\n<li>максимальная внутренняя SEO оптимизация проекта</li>\r\n<li>высококачественная оптимизация скорости загрузки сайта и его работы</li>\r\n<li>12 уровней защиты от взлома сайта</li>\r\n<li>высокие стандарты качества кода</li>\r\n</ul>\r\n</div>\r\n</li>\r\n<!--/stages  item --> <!-- stages  item -->\r\n<li class="stages__item hor-sizing hor-snap contenting">\r\n<h3>Контент</h3>\r\n<div>\r\n<ul>\r\n<li>разработка контент стратегии</li>\r\n<li>текстовые и графические материалы. подготовка, обработка, размещение на сайте</li>\r\n<li>составление эмоциональных промо и продающих текстов</li>\r\n<li>подготовка SEO оптимизированных текстов</li>\r\n</ul>\r\n</div>\r\n</li>\r\n<!--/stages  item --> <!-- stages  item -->\r\n<li class="stages__item hor-sizing hor-snap supporting">\r\n<h3>Поддержка</h3>\r\n<div>\r\n<ul>\r\n<li>все виды работ с контентом</li>\r\n<li>аудит эффективности SEO продвижения</li>\r\n<li>анализ поведения посетителей на сайте</li>\r\n<li>мониторинг работоспособности сайта и устранение технических проблем</li>\r\n</ul>\r\n</div>\r\n</li>\r\n<!--/stages  item --></ul>\r\n<!--/stages  list --></div>\r\n<!--/stages  scroll --></div>\r\n<!--/stages  layout --></div>\r\n<!--/stages  wrap --></div>', '<div class="customers"><!-- customers  background text -->\r\n<div class="customers__background-text">P.S.</div>\r\n<!--/customers  background text --> <!-- layout -->\r\n<div class="layout">\r\n<h2>что получает наш клиент</h2>\r\n<ul>\r\n<li>консультацию по особенностям интернет-продаж</li>\r\n<li>гарантию защиты конфиденциальных данных</li>\r\n<li>сайт с высоким процентом конверсий и серьезным уровнем SEO оптимизации</li>\r\n<li>умеренную цену</li>\r\n<li>техническое и маркетинговое сопровождение</li>\r\n</ul>\r\n</div>\r\n<!--/layout --></div>', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 'ua', 'Портфоліо', 'portfolio', 'Портфоліо', '', 'Портфоліо', 'Портфоліо', '', '', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 'ua', 'Комерцiйне', 'commercial', 'Комерцiйне', 'Комерцiйне', 'Комерцiйне', 'Комерцiйне', 'Комерцiйне', '<p>Комерцiйне</p>', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 'ua', 'Контакти', 'cont', 'Контакти', '', 'Контакти', 'Контакти', '', '<p>Контакти</p>', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'В контакті', '', 'Твіттер', '', '', '', ''),
(6, 'ua', 'Посадкова сторінка', 'landing-page', 'Посадкова сторінка', 'Посадкова сторінка', 'Посадкова сторінка', 'Посадкова сторінка', 'Посадкова сторінка', '<p>Посадкова сторінка</p>', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `filters`
--

CREATE TABLE IF NOT EXISTS `filters` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `show` tinyint(1) unsigned NOT NULL COMMENT 'Показать/скрыть',
  `url` varchar(100) NOT NULL COMMENT 'Url страницы',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pUrl` (`url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `filters`
--

INSERT INTO `filters` (`id`, `show`, `url`) VALUES
(1, 1, 'filter-1'),
(2, 1, 'filter-2'),
(3, 1, 'filter-3');

-- --------------------------------------------------------

--
-- Структура таблицы `filters_content`
--

CREATE TABLE IF NOT EXISTS `filters_content` (
  `idFilters` int(3) unsigned NOT NULL COMMENT 'Id модуля',
  `lang` varchar(2) NOT NULL COMMENT 'Язык',
  `title` varchar(100) NOT NULL COMMENT 'Заголовок страницы',
  KEY `idFilters` (`idFilters`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `filters_content`
--

INSERT INTO `filters_content` (`idFilters`, `lang`, `title`) VALUES
(1, 'ua', 'Фільтр 1'),
(1, 'ru', 'Фильтр 1'),
(1, 'en', 'Filter 1'),
(2, 'en', 'Filter 2'),
(2, 'ru', 'Фильтр 2'),
(2, 'ua', 'Фільтр 2'),
(3, 'ru', 'Фильтр 3'),
(3, 'ua', 'Фільтр 3'),
(3, 'en', 'Filter 3');

-- --------------------------------------------------------

--
-- Структура таблицы `langs`
--

CREATE TABLE IF NOT EXISTS `langs` (
  `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `sName` varchar(5) NOT NULL DEFAULT '' COMMENT 'Название языка ',
  `bName` varchar(5) NOT NULL DEFAULT '' COMMENT 'название языка заглавными буквами',
  `code2` varchar(5) NOT NULL DEFAULT '' COMMENT 'Двухбуквенный код языка',
  `code3` varchar(5) DEFAULT NULL COMMENT '3-х буквенный код языка',
  `fullName` varchar(20) NOT NULL DEFAULT '' COMMENT 'Полное название языка',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461 COMMENT='Языки сайта' AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `langs`
--

INSERT INTO `langs` (`id`, `sName`, `bName`, `code2`, `code3`, `fullName`) VALUES
(1, 'ru', 'RU', 'ru', 'rus', 'Русский'),
(2, 'ua', 'UA', 'uk', 'ukr', 'Українська'),
(3, 'en', 'EN', 'en', 'eng', 'English');

-- --------------------------------------------------------

--
-- Структура таблицы `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `idTextpages` int(3) unsigned NOT NULL COMMENT 'Текстовая страница',
  `order` int(3) unsigned NOT NULL COMMENT 'Порядок сортировки',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `links`
--

INSERT INTO `links` (`id`, `idTextpages`, `order`) VALUES
(1, 1, 4),
(2, 2, 3),
(3, 3, 2),
(4, 5, 1),
(5, 4, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `links_content`
--

CREATE TABLE IF NOT EXISTS `links_content` (
  `idLinks` int(3) unsigned NOT NULL COMMENT 'Id модуля',
  `lang` varchar(2) NOT NULL COMMENT 'Язык',
  `title` varchar(50) NOT NULL COMMENT 'Заголовок',
  UNIQUE KEY `idLinks` (`idLinks`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `links_content`
--

INSERT INTO `links_content` (`idLinks`, `lang`, `title`) VALUES
(1, 'en', 'Link 1'),
(1, 'ru', 'Ссылка 1'),
(1, 'ua', 'Посилання 1'),
(2, 'en', 'Link 2'),
(2, 'ru', 'Ссылка 2'),
(2, 'ua', 'Посилання 2'),
(3, 'en', 'Link 3'),
(3, 'ru', 'Ссылка 3'),
(3, 'ua', 'Посилання 3'),
(4, 'en', ''),
(4, 'ru', 'Ссылка 4'),
(4, 'ua', ''),
(5, 'en', ''),
(5, 'ru', 'Ссылка 5'),
(5, 'ua', '');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1460382227);

-- --------------------------------------------------------

--
-- Структура таблицы `pagegroup`
--

CREATE TABLE IF NOT EXISTS `pagegroup` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'идентификатор группы',
  `groupName` varchar(50) NOT NULL COMMENT 'Название группы',
  `adminClass` varchar(50) NOT NULL DEFAULT '' COMMENT 'Класс для контроллера админки',
  `cssKlass` varchar(50) NOT NULL COMMENT 'css класс для иконки в меню',
  `addParam` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT 'Признак дополнительных параметров если они нужны 0 нет 1 да',
  `groupLevel` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT 'Уровнь вложенности группы',
  `idParentGroup` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Идентификатор родителя группы',
  `quickButton` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT 'Группа учасвствует в быстрых кнопках',
  `picking` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT 'Порядок сортировки страниц',
  `idTextPage` int(3) NOT NULL COMMENT 'Id текстовой страницы',
  `groupMark` varchar(50) NOT NULL COMMENT 'Отличительное имя',
  `ignoreMenu` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Не включать страницу в меню админки',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=2048 COMMENT='группы страниц для главного бокового меню' AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `pagegroup`
--

INSERT INTO `pagegroup` (`id`, `groupName`, `adminClass`, `cssKlass`, `addParam`, `groupLevel`, `idParentGroup`, `quickButton`, `picking`, `idTextPage`, `groupMark`, `ignoreMenu`) VALUES
(1, 'Текстовые', 'text/', 'text', 0, 1, 0, 0, 6, 0, '', 0),
(2, 'Настройки', 'settings/', 'setting', 0, 1, 0, 0, 20, 0, '', 0),
(3, 'Работы', 'works/', 'works', 0, 1, 0, 0, 1, 0, 'Работы', 0),
(4, 'Фильтры', 'filters/', 'filters', 0, 1, 0, 0, 1, 0, 'Фильтры', 0),
(7, 'Ссылки (для плашки сссылок в футере)', 'links/', 'links', 0, 1, 0, 0, 1, 0, 'Ссылки (для плашки сссылок в футере)', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор страницы',
  `pShow` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT 'Показывать станицу 0- нет 1- да',
  `Url` varchar(255) NOT NULL COMMENT 'Ссылка на страницу (псевдоним страницы)',
  `pAdd` tinyint(4) unsigned NOT NULL COMMENT 'Можно ли добавлять дочерние документы 0 - нет, 1 - можно',
  `pEdit` tinyint(4) unsigned NOT NULL COMMENT 'Можно ли редактировать документ 0- нет, 1 - можно',
  `pDel` tinyint(4) unsigned NOT NULL COMMENT 'Можно ли удалять страницу 0 - нет, 1 - можно',
  `class` varchar(50) NOT NULL COMMENT 'Класс для контроллера сайта',
  `adminClass` varchar(50) NOT NULL COMMENT 'Класс для контроллера админки',
  `pageAdminType` tinyint(4) unsigned NOT NULL COMMENT 'Тип страницы 0 - страница, 1 - каталог',
  `parentId` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Идентификатор родителя',
  `level` tinyint(4) unsigned NOT NULL COMMENT 'Уровень вложенности страницы',
  `pageMenuNum` tinyint(4) unsigned NOT NULL COMMENT 'Номер страницы в админке согласно родителю',
  `m1` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT 'Сортировка для меню 1',
  `m2` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT 'Сортировка для меню 2',
  `pageOrder` tinyint(4) unsigned NOT NULL COMMENT 'Сортировка страницы в нутри уровня',
  `priority` enum('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0') NOT NULL DEFAULT '0.0' COMMENT 'Приоритет страницы',
  `changefreq` enum('always','hourly','daily','weekly','monthly','yearly','never') NOT NULL DEFAULT 'monthly' COMMENT 'Периодичность обновления',
  `idPageGroup` int(11) unsigned NOT NULL DEFAULT '1' COMMENT 'Идентификатор группы текстовых страниц к которой относится данная',
  `pAlias` varchar(50) NOT NULL COMMENT 'Отличительное имя (англ)',
  `urlMethod` varchar(50) NOT NULL COMMENT 'Имя метода textPagesUrlProvider',
  `pageMark` varchar(50) NOT NULL COMMENT 'Отличительное имя',
  `image` varchar(100) NOT NULL COMMENT 'Одиночное изображение',
  `imageWidth` int(3) unsigned NOT NULL COMMENT 'Одиночное изображение - ширина',
  `imageHeight` int(3) unsigned NOT NULL COMMENT 'Одиночное изображение - высота',
  `idFilters` int(3) unsigned NOT NULL COMMENT 'Фильтр',
  `idWorks` int(3) unsigned NOT NULL COMMENT 'Отображаемые работы',
  `imagebgsbk` varchar(100) NOT NULL COMMENT 'Изображение для background',
  `imagebgsbkWidth` int(3) unsigned NOT NULL COMMENT 'Изображение для background - ширина',
  `imagebgsbkHeight` int(3) unsigned NOT NULL COMMENT 'Изображение для background - высота',
  `imagebgsbklp` varchar(100) NOT NULL COMMENT 'Изображение для background(laptop 1487x736)',
  `imagebgsbklpWidth` int(3) unsigned NOT NULL COMMENT 'Изображение для background(laptop 1487x736) - ширина',
  `imagebgsbklpHeight` int(3) unsigned NOT NULL COMMENT 'Изображение для background(laptop 1487x736) - высота',
  `imagebgsbkmb` varchar(100) NOT NULL COMMENT 'Изображение для background(mobile 970x480)',
  `imagebgsbkmbWidth` int(3) unsigned NOT NULL COMMENT 'Изображение для background(mobile 970x480) - ширина',
  `imagebgsbkmbHeight` int(3) unsigned NOT NULL COMMENT 'Изображение для background(mobile 970x480) - высота',
  `idWorks1` int(255) NOT NULL,
  `idWorks2` int(255) NOT NULL,
  `idWorks3` int(255) NOT NULL,
  `idWorks4` int(255) NOT NULL,
  `idWorks5` int(255) NOT NULL,
  `idWorks6` int(255) NOT NULL,
  `idWorks7` int(255) NOT NULL,
  `sbkimgwork1` varchar(100) NOT NULL COMMENT 'Изображение для работы №1',
  `sbkimgwork1Width` int(3) unsigned NOT NULL COMMENT 'Изображение для работы №1 - ширина',
  `sbkimgwork1Height` int(3) unsigned NOT NULL COMMENT 'Изображение для работы №1 - высота',
  `sbkimgwork2` varchar(100) NOT NULL COMMENT 'Изображение для работы №2',
  `sbkimgwork2Width` int(3) unsigned NOT NULL COMMENT 'Изображение для работы №2 - ширина',
  `sbkimgwork2Height` int(3) unsigned NOT NULL COMMENT 'Изображение для работы №2 - высота',
  `sbkimgwork3` varchar(100) NOT NULL COMMENT 'Изображение для работы №3',
  `sbkimgwork3Width` int(3) unsigned NOT NULL COMMENT 'Изображение для работы №3 - ширина',
  `sbkimgwork3Height` int(3) unsigned NOT NULL COMMENT 'Изображение для работы №3 - высота',
  `sbkimgwork4` varchar(100) NOT NULL COMMENT 'Изображение для работы №4',
  `sbkimgwork4Width` int(3) unsigned NOT NULL COMMENT 'Изображение для работы №4 - ширина',
  `sbkimgwork4Height` int(3) unsigned NOT NULL COMMENT 'Изображение для работы №4 - высота',
  `sbkimgwork5` varchar(100) NOT NULL COMMENT 'Изображение для работы №5',
  `sbkimgwork5Width` int(3) unsigned NOT NULL COMMENT 'Изображение для работы №5 - ширина',
  `sbkimgwork5Height` int(3) unsigned NOT NULL COMMENT 'Изображение для работы №5 - высота',
  `sbkimgwork6` varchar(100) NOT NULL COMMENT 'Изображение для работы №6',
  `sbkimgwork6Width` int(3) unsigned NOT NULL COMMENT 'Изображение для работы №6 - ширина',
  `sbkimgwork6Height` int(3) unsigned NOT NULL COMMENT 'Изображение для работы №6 - высота',
  `sbkimgwork7` varchar(100) NOT NULL COMMENT 'Изображение для работы №7',
  `sbkimgwork7Width` int(3) unsigned NOT NULL COMMENT 'Изображение для работы №7 - ширина',
  `sbkimgwork7Height` int(3) unsigned NOT NULL COMMENT 'Изображение для работы №7 - высота',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`Url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=1365 COMMENT='Таблица содержащая основные данныее о страницах сайта' AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `pShow`, `Url`, `pAdd`, `pEdit`, `pDel`, `class`, `adminClass`, `pageAdminType`, `parentId`, `level`, `pageMenuNum`, `m1`, `m2`, `pageOrder`, `priority`, `changefreq`, `idPageGroup`, `pAlias`, `urlMethod`, `pageMark`, `image`, `imageWidth`, `imageHeight`, `idFilters`, `idWorks`, `imagebgsbk`, `imagebgsbkWidth`, `imagebgsbkHeight`, `imagebgsbklp`, `imagebgsbklpWidth`, `imagebgsbklpHeight`, `imagebgsbkmb`, `imagebgsbkmbWidth`, `imagebgsbkmbHeight`, `idWorks1`, `idWorks2`, `idWorks3`, `idWorks4`, `idWorks5`, `idWorks6`, `idWorks7`, `sbkimgwork1`, `sbkimgwork1Width`, `sbkimgwork1Height`, `sbkimgwork2`, `sbkimgwork2Width`, `sbkimgwork2Height`, `sbkimgwork3`, `sbkimgwork3Width`, `sbkimgwork3Height`, `sbkimgwork4`, `sbkimgwork4Width`, `sbkimgwork4Height`, `sbkimgwork5`, `sbkimgwork5Width`, `sbkimgwork5Height`, `sbkimgwork6`, `sbkimgwork6Width`, `sbkimgwork6Height`, `sbkimgwork7`, `sbkimgwork7Width`, `sbkimgwork7Height`) VALUES
(1, 1, 'index', 0, 1, 0, 'index', 'text/pages/index', 0, 0, 0, 1, 0, 0, 1, '1.0', 'daily', 1, 'index', 'getIndexUrl', '', '', 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0),
(2, 1, 'sites-by-keys', 0, 1, 0, 'sitesbykeys', 'text/pages/sitesbykeys', 0, 0, 0, 1, 0, 0, 1, '0.0', 'monthly', 1, 'sitesbykeys', 'getSitesByKeysUrl', '', '', 0, 0, 0, 0, '2-imagebgsbk.jpg', 1920, 950, '2-imagebgsbklp.jpg', 1920, 950, '2-imagebgsbkmb.jpg', 1920, 950, 1, 2, 3, 4, 5, 1, 2, '2-sbkimgwork1.jpg', 0, 0, '2-sbkimgwork2.jpg', 0, 0, '2-sbkimgwork3.jpg', 0, 0, '2-sbkimgwork4.jpg', 0, 0, '2-sbkimgwork5.jpg', 0, 0, '2-sbkimgwork6.jpg', 0, 0, '2-sbkimgwork7.jpg', 0, 0),
(3, 1, 'portfolio', 0, 1, 0, 'sitesbykeys', 'text/pages/portfolio', 0, 0, 0, 1, 0, 0, 1, '0.0', 'monthly', 1, 'portfolio', 'getPortfolioUrl', '', '', 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0),
(4, 1, 'commercial', 0, 1, 0, 'commercial', 'text/pages/commercial', 0, 0, 0, 1, 0, 0, 1, '1.0', 'monthly', 1, 'commercial', 'getCommercialUrl', '', '', 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0),
(5, 1, 'contacts', 0, 1, 0, 'contacts', 'text/pages/contacts', 0, 0, 0, 1, 0, 0, 1, '0.0', 'monthly', 1, 'contacts', 'getContactsUrl', '', '', 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0),
(6, 1, 'landing-page', 0, 1, 0, 'sitesbykeys', 'text/pages/landingpage', 0, 0, 0, 1, 0, 0, 1, '0.0', 'monthly', 1, 'landingpage', 'getLandingpageUrl', '', '', 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `pagessbk_work`
--

CREATE TABLE IF NOT EXISTS `pagessbk_work` (
  `idPages` int(255) NOT NULL,
  `idWorks` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pages_links`
--

CREATE TABLE IF NOT EXISTS `pages_links` (
  `idPages` int(6) unsigned NOT NULL COMMENT 'Id модуля',
  `idLinks` int(3) unsigned NOT NULL COMMENT 'Id некоторого списка',
  KEY `idPages` (`idPages`),
  KEY `idLinks` (`idLinks`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages_links`
--

INSERT INTO `pages_links` (`idPages`, `idLinks`) VALUES
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(5, 1),
(5, 2),
(5, 3),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(3, 1),
(3, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `pages_sbkpslist`
--

CREATE TABLE IF NOT EXISTS `pages_sbkpslist` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `idRel` int(3) unsigned NOT NULL COMMENT 'Id модуля',
  `lang` varchar(2) NOT NULL COMMENT 'Язык',
  `text` varchar(100) NOT NULL COMMENT 'Текст',
  PRIMARY KEY (`id`),
  KEY `idRel` (`idRel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=578 ;

--
-- Дамп данных таблицы `pages_sbkpslist`
--

INSERT INTO `pages_sbkpslist` (`id`, `idRel`, `lang`, `text`) VALUES
(457, 2, 'en', 'change me'),
(573, 2, 'ru', 'консультацию по особенностям интернет-продаж'),
(574, 2, 'ru', 'гарантию защиты конфиденциальных данных'),
(575, 2, 'ru', 'сайт с высоким процентом конверсий и серьезным уровнем SEO оптимизации'),
(576, 2, 'ru', 'умеренную цену'),
(577, 2, 'ru', 'техническое и маркетинговое сопровождение');

-- --------------------------------------------------------

--
-- Структура таблицы `pages_sbkstagelist1`
--

CREATE TABLE IF NOT EXISTS `pages_sbkstagelist1` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `idRel` int(3) unsigned NOT NULL COMMENT 'Id модуля',
  `lang` varchar(2) NOT NULL COMMENT 'Язык',
  `text` varchar(100) NOT NULL COMMENT 'Текст',
  PRIMARY KEY (`id`),
  KEY `idRel` (`idRel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=829 ;

--
-- Дамп данных таблицы `pages_sbkstagelist1`
--

INSERT INTO `pages_sbkstagelist1` (`id`, `idRel`, `lang`, `text`) VALUES
(660, 2, 'en', 'change me'),
(822, 2, 'ru', 'определение задач и целей проекта'),
(823, 2, 'ru', 'анализ Вашей бизнес-модели'),
(824, 2, 'ru', 'аудит Вашей отрасли в Интернет'),
(825, 2, 'ru', 'определение и исследование целевой адуитории'),
(826, 2, 'ru', 'аудит Вашего сайта'),
(827, 2, 'ru', 'анализ сайтов конкурентов'),
(828, 2, 'ru', 'разработка перечня маркетинговых рекомендаций для будущего сайта');

-- --------------------------------------------------------

--
-- Структура таблицы `pages_sbkstagelist2`
--

CREATE TABLE IF NOT EXISTS `pages_sbkstagelist2` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `idRel` int(3) unsigned NOT NULL COMMENT 'Id модуля',
  `lang` varchar(2) NOT NULL COMMENT 'Язык',
  `text` varchar(100) NOT NULL COMMENT 'Текст',
  PRIMARY KEY (`id`),
  KEY `idRel` (`idRel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=705 ;

--
-- Дамп данных таблицы `pages_sbkstagelist2`
--

INSERT INTO `pages_sbkstagelist2` (`id`, `idRel`, `lang`, `text`) VALUES
(560, 2, 'en', 'change me'),
(699, 2, 'ru', 'пределение необходимых технических требований'),
(700, 2, 'ru', 'проектирование схем воронок продаж'),
(701, 2, 'ru', 'проектирование схем привлечения трафика'),
(702, 2, 'ru', 'разработка стурктуры сайта'),
(703, 2, 'ru', 'проектирование интерфейсов с учетом множества доступных устройств пользователю'),
(704, 2, 'ru', 'подготовка технических заданий для проектной группы');

-- --------------------------------------------------------

--
-- Структура таблицы `pages_sbkstagelist3`
--

CREATE TABLE IF NOT EXISTS `pages_sbkstagelist3` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `idRel` int(3) unsigned NOT NULL COMMENT 'Id модуля',
  `lang` varchar(2) NOT NULL COMMENT 'Язык',
  `text` varchar(100) NOT NULL COMMENT 'Текст',
  PRIMARY KEY (`id`),
  KEY `idRel` (`idRel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=588 ;

--
-- Дамп данных таблицы `pages_sbkstagelist3`
--

INSERT INTO `pages_sbkstagelist3` (`id`, `idRel`, `lang`, `text`) VALUES
(467, 2, 'en', 'change me'),
(583, 2, 'ru', 'современные графические и интерактивные решения'),
(584, 2, 'ru', 'эмоциональное воздействие на целевую аудиторию'),
(585, 2, 'ru', 'разработка сценариев для интерактивных элементов и анимационных эффектов'),
(586, 2, 'ru', 'применение практик повышения уровня конверсии'),
(587, 2, 'ru', 'использование методик по улучшению степени удобности использования сайтом');

-- --------------------------------------------------------

--
-- Структура таблицы `pages_sbkstagelist4`
--

CREATE TABLE IF NOT EXISTS `pages_sbkstagelist4` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `idRel` int(3) unsigned NOT NULL COMMENT 'Id модуля',
  `lang` varchar(2) NOT NULL COMMENT 'Язык',
  `text` varchar(100) NOT NULL COMMENT 'Текст',
  PRIMARY KEY (`id`),
  KEY `idRel` (`idRel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=822 ;

--
-- Дамп данных таблицы `pages_sbkstagelist4`
--

INSERT INTO `pages_sbkstagelist4` (`id`, `idRel`, `lang`, `text`) VALUES
(653, 2, 'en', 'change me'),
(815, 2, 'ru', 'современные технологии веб разработки'),
(816, 2, 'ru', 'индивидуальные решения под Ваши задачи'),
(817, 2, 'ru', 'оптимизация работы операторов сайта'),
(818, 2, 'ru', 'максимальная внутренняя SEO оптимизация проекта'),
(819, 2, 'ru', 'высококачественная оптимизация скорости загрузки сайта и его работы'),
(820, 2, 'ru', '12 уровней защиты от взлома сайта'),
(821, 2, 'ru', 'высокие стандарты качества кода');

-- --------------------------------------------------------

--
-- Структура таблицы `pages_sbkstagelist5`
--

CREATE TABLE IF NOT EXISTS `pages_sbkstagelist5` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `idRel` int(3) unsigned NOT NULL COMMENT 'Id модуля',
  `lang` varchar(2) NOT NULL COMMENT 'Язык',
  `text` varchar(100) NOT NULL COMMENT 'Текст',
  PRIMARY KEY (`id`),
  KEY `idRel` (`idRel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=471 ;

--
-- Дамп данных таблицы `pages_sbkstagelist5`
--

INSERT INTO `pages_sbkstagelist5` (`id`, `idRel`, `lang`, `text`) VALUES
(374, 2, 'en', 'change me'),
(467, 2, 'ru', 'разработка контент стратегии'),
(468, 2, 'ru', 'текстовые и графические материалы. подготовка, обработка, размещение на сайте'),
(469, 2, 'ru', 'составление эмоциональных промо и продающих текстов'),
(470, 2, 'ru', 'подготовка SEO оптимизированных текстов');

-- --------------------------------------------------------

--
-- Структура таблицы `pages_sbkstagelist6`
--

CREATE TABLE IF NOT EXISTS `pages_sbkstagelist6` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `idRel` int(3) unsigned NOT NULL COMMENT 'Id модуля',
  `lang` varchar(2) NOT NULL COMMENT 'Язык',
  `text` varchar(100) NOT NULL COMMENT 'Текст',
  PRIMARY KEY (`id`),
  KEY `idRel` (`idRel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=471 ;

--
-- Дамп данных таблицы `pages_sbkstagelist6`
--

INSERT INTO `pages_sbkstagelist6` (`id`, `idRel`, `lang`, `text`) VALUES
(374, 2, 'en', 'change me'),
(467, 2, 'ru', 'все виды работ с контентом'),
(468, 2, 'ru', 'аудит эффективности SEO продвижения'),
(469, 2, 'ru', 'анализ поведения посетителей на сайте'),
(470, 2, 'ru', 'мониторинг работоспособности сайта и устранение технических проблем');

-- --------------------------------------------------------

--
-- Структура таблицы `pages_works`
--

CREATE TABLE IF NOT EXISTS `pages_works` (
  `idPages` int(6) unsigned NOT NULL COMMENT 'Id модуля',
  `idWorks` int(3) unsigned NOT NULL COMMENT 'Id некоторого списка',
  KEY `idPages` (`idPages`),
  KEY `idWorks` (`idWorks`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pages_works_content`
--

CREATE TABLE IF NOT EXISTS `pages_works_content` (
  `idPages` int(6) unsigned NOT NULL COMMENT 'Id модуля',
  `idWorks_content` int(3) unsigned NOT NULL COMMENT 'Id некоторого списка',
  KEY `idPages` (`idPages`),
  KEY `idWorks_content` (`idWorks_content`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `emailCall` varchar(100) NOT NULL COMMENT 'Email для заказа звонков',
  `emailClaim` varchar(100) NOT NULL COMMENT 'Email для заявок',
  `snVkontakte` varchar(100) NOT NULL COMMENT 'Ссылка Вконтакте',
  `snFacebook` varchar(100) NOT NULL COMMENT 'Ссылка Фэйсбук',
  `snTwitter` varchar(100) NOT NULL COMMENT 'Ссылка Твиттер',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Настройки' AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `emailCall`, `emailClaim`, `snVkontakte`, `snFacebook`, `snTwitter`) VALUES
(1, '', 'krekotenko@gmail.com;kanonir2012@gmail.com', 'vklink', 'fblink', 'twlink');

-- --------------------------------------------------------

--
-- Структура таблицы `settings_content`
--

CREATE TABLE IF NOT EXISTS `settings_content` (
  `idSettings` int(3) unsigned NOT NULL COMMENT 'Id настроек',
  `lang` varchar(2) NOT NULL COMMENT 'Язык',
  `address` varchar(100) NOT NULL COMMENT 'Адрес',
  `copyright` varchar(100) NOT NULL COMMENT 'Копирайт',
  UNIQUE KEY `idSettings` (`idSettings`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Настройки (контент)';

--
-- Дамп данных таблицы `settings_content`
--

INSERT INTO `settings_content` (`idSettings`, `lang`, `address`, `copyright`) VALUES
(1, 'en', 'Address', 'Copyrihgt'),
(1, 'ru', 'Адресcc', 'Копирайт'),
(1, 'ua', 'Адреса', 'Копірайт');

-- --------------------------------------------------------

--
-- Структура таблицы `settings_pages`
--

CREATE TABLE IF NOT EXISTS `settings_pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор страницы настроек',
  `settingsName` varchar(50) NOT NULL COMMENT 'Название группы',
  `adminClass` varchar(50) NOT NULL COMMENT 'Класс для контроллера админки',
  `pageAdminType` tinyint(4) unsigned NOT NULL COMMENT 'Тип страницы 0 - страница, 1 - каталог',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=1365 COMMENT='Таблица содержащая основные данныее о страницах настройках сайта' AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `settings_pages`
--

INSERT INTO `settings_pages` (`id`, `settingsName`, `adminClass`, `pageAdminType`) VALUES
(1, 'Обновить карту сайта', 'settings/settings/sitemap', 0),
(2, 'Дапм базы данных', 'settings/settings/dump', 0),
(3, 'Управление учётными записями менеджеров сайта', 'settings/settings/manager', 1),
(4, 'Личный кабинет', 'settings/settings/privateoffice', 0),
(5, 'Настройки', 'settings/settings/mysettings', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '10',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `surname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AVG_ROW_LENGTH=8192 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role`, `status`, `created_at`, `updated_at`, `name`, `surname`) VALUES
(1, 'iiivanov', 'yl8pb68GZkgus60R5FKVwys_4Dz4cbWs', '$2y$13$22nXH9j6KSY3iDO9s3w9Xu4bzWyHIgSu.GvLIf8r5gmkKpc9eP.5i', NULL, 'iiivanov.ukraine@gmail.com', 10, 10, 1421058704, 1421058704, 'Иван', 'Иванов');

-- --------------------------------------------------------

--
-- Структура таблицы `works`
--

CREATE TABLE IF NOT EXISTS `works` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `show` tinyint(1) unsigned NOT NULL COMMENT 'Показать/скрыть',
  `pUrl` varchar(100) NOT NULL COMMENT 'Url страницы',
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата добавления',
  `idFilters` int(3) unsigned NOT NULL COMMENT 'Фильтр',
  `image` varchar(100) NOT NULL COMMENT 'Одиночное изображение',
  `imageWidth` int(3) unsigned NOT NULL COMMENT 'Одиночное изображение - ширина',
  `imageHeight` int(3) unsigned NOT NULL COMMENT 'Одиночное изображение - высота',
  `imageWidth2` int(3) unsigned NOT NULL,
  `imageHeight2` int(3) unsigned NOT NULL,
  `imageprtf` varchar(100) NOT NULL COMMENT 'Одиночное изображение для страницы портфолио',
  `imageprtfWidth` int(3) unsigned NOT NULL COMMENT 'Одиночное изображение для страницы портфолио - ширина',
  `imageprtfHeight` int(3) unsigned NOT NULL COMMENT 'Одиночное изображение для страницы портфолио - высота',
  `imagebg` varchar(100) NOT NULL COMMENT 'Изображение для background',
  `imagebgWidth` int(3) unsigned NOT NULL COMMENT 'Изображение для background - ширина',
  `imagebgHeight` int(3) unsigned NOT NULL COMMENT 'Изображение для background - высота',
  `imagebgWidth2` int(3) NOT NULL COMMENT 'Изображение для backgrounnd',
  `imagebgHeight2` int(3) NOT NULL COMMENT 'Изображение для backgrounnd',
  `imagebgWidth3` int(3) NOT NULL COMMENT 'Изображение для backgrounnd',
  `imagebgHeight3` int(3) NOT NULL COMMENT 'Изображение для backgrounnd',
  `mainpage` varchar(100) NOT NULL COMMENT 'Изображение главной страницы',
  `mainpageWidth` int(3) unsigned NOT NULL COMMENT 'Изображение главной страницы - ширина',
  `mainpageHeight` int(3) unsigned NOT NULL COMMENT 'Изображение главной страницы - высота',
  `mainpageWidth2` int(3) NOT NULL COMMENT 'Изображение главной страницы - ширина',
  `mainpageHeight2` int(3) NOT NULL COMMENT 'Изображение главной страницы - высота',
  `mainpageWidth3` int(3) NOT NULL COMMENT 'Изображение главной страницы - ширина',
  `mainpageHeight3` int(3) NOT NULL COMMENT 'Изображение главной страницы - высота',
  `mainpageWidth4` int(3) NOT NULL COMMENT 'Изображение главной страницы - ширина',
  `mainpageHeight4` int(3) NOT NULL COMMENT 'Изображение главной страницы - высота',
  `addpage` varchar(100) NOT NULL COMMENT 'Изображение доп.возможностей',
  `addpageWidth` int(3) unsigned NOT NULL COMMENT 'Изображение доп.возможностей - ширина',
  `addpageHeight` int(3) unsigned NOT NULL COMMENT 'Изображение доп.возможностей - высота',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pUrl` (`pUrl`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `works`
--

INSERT INTO `works` (`id`, `show`, `pUrl`, `dateCreated`, `idFilters`, `image`, `imageWidth`, `imageHeight`, `imageWidth2`, `imageHeight2`, `imageprtf`, `imageprtfWidth`, `imageprtfHeight`, `imagebg`, `imagebgWidth`, `imagebgHeight`, `imagebgWidth2`, `imagebgHeight2`, `imagebgWidth3`, `imagebgHeight3`, `mainpage`, `mainpageWidth`, `mainpageHeight`, `mainpageWidth2`, `mainpageHeight2`, `mainpageWidth3`, `mainpageHeight3`, `mainpageWidth4`, `mainpageHeight4`, `addpage`, `addpageWidth`, `addpageHeight`) VALUES
(1, 1, 'robota&nbsp;&mdash; 1', '2016-03-07 14:21:15', 1, '1-image.jpg', 1024, 640, 297, 381, '1-imageprtf.jpg', 1920, 345, '1-imagebg.jpg', 1920, 1200, 1178, 736, 768, 480, '1-mainpage.jpg', 900, 2560, 704, 2002, 296, 842, 0, 0, '', 0, 0),
(2, 1, 'robota-2', '2016-03-07 14:22:29', 1, '2-image.jpg', 1024, 640, 297, 381, '2-imageprtf.jpg', 1920, 345, '2-imagebg.jpg', 1920, 1200, 1178, 736, 768, 480, '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0),
(3, 1, 'robota-3', '2016-03-07 14:22:59', 3, '3-image.jpg', 1024, 640, 297, 381, '3-imageprtf.jpg', 1920, 345, '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0),
(4, 1, 'robota-4', '2016-03-31 07:16:42', 1, '4-image.jpg', 1024, 640, 297, 381, '4-imageprtf.jpg', 1920, 345, '', 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0),
(5, 1, 'robota-5', '2016-03-31 14:55:05', 1, '5-image.jpg', 1024, 640, 297, 381, '5-imageprtf.jpg', 1920, 345, '5-imagebg.jpg', 1920, 1080, 1178, 736, 768, 480, '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `works_content`
--

CREATE TABLE IF NOT EXISTS `works_content` (
  `idWorks` int(3) unsigned NOT NULL COMMENT 'Id модуля',
  `lang` varchar(2) NOT NULL COMMENT 'Язык',
  `pTitle` varchar(100) NOT NULL COMMENT 'Заголовок страницы',
  `pKeyWords` varchar(255) NOT NULL COMMENT 'Метатег ключевые слова',
  `pDescription` varchar(255) NOT NULL COMMENT 'Метатег описание',
  `pH1` varchar(100) NOT NULL COMMENT 'Заголовок h1',
  `pMenuName` varchar(100) NOT NULL COMMENT 'Название в меню',
  `pBreadCrumbs` varchar(100) NOT NULL COMMENT 'Текст для хлебных крошек',
  `pContent` text NOT NULL COMMENT 'Содержимое страницы',
  `description` varchar(255) NOT NULL COMMENT 'Описание',
  `imageTitle` varchar(100) NOT NULL COMMENT 'Одиночное изображение - заголовок',
  `imageprtfTitle` varchar(100) NOT NULL COMMENT 'Одиночное изображение для страницы портфолио - заголовок',
  `imagebgTitle` varchar(100) NOT NULL COMMENT 'Изображение для background - заголовок',
  `client` varchar(50) NOT NULL COMMENT 'Клиент',
  `services` varchar(100) NOT NULL COMMENT 'Услуги',
  `launch` varchar(50) NOT NULL COMMENT 'Lauch',
  `aboutProject` text NOT NULL COMMENT 'group',
  `task` text NOT NULL COMMENT 'задача',
  `descrofsolut` varchar(255) NOT NULL COMMENT 'Описание решения',
  `linkwork` varchar(50) NOT NULL COMMENT 'Ссылка на работу',
  `mainpageTitle` varchar(100) NOT NULL COMMENT 'Изображение главной страницы - заголовок',
  `add` varchar(255) NOT NULL COMMENT 'Дополнительные возможности',
  `addpageTitle` varchar(100) NOT NULL COMMENT 'Изображение доп.возможностей - заголовок',
  `results` text NOT NULL COMMENT 'Результаты',
  `worksdesсsbk` varchar(255) NOT NULL COMMENT 'Описание для страницы сайты под ключ',
  `solutions` text NOT NULL COMMENT 'Решение',
  UNIQUE KEY `idWorks` (`idWorks`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `works_content`
--

INSERT INTO `works_content` (`idWorks`, `lang`, `pTitle`, `pKeyWords`, `pDescription`, `pH1`, `pMenuName`, `pBreadCrumbs`, `pContent`, `description`, `imageTitle`, `imageprtfTitle`, `imagebgTitle`, `client`, `services`, `launch`, `aboutProject`, `task`, `descrofsolut`, `linkwork`, `mainpageTitle`, `add`, `addpageTitle`, `results`, `worksdesсsbk`, `solutions`) VALUES
(1, 'en', 'Work 1', '', 'Work 1', 'Work 1', '', '', '', 'Work 1 - description', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(1, 'ru', 'Teksan', '', 'Работа 1', 'Teksan', '', '', '', 'Тексан&nbsp;&mdash; Россия', '', '', '', 'Тексан&nbsp;&mdash; Россия', 'Проектирование, дизайн, разработка, подготовка текстов.', '2014', '<p>Проектирование, арт директор &ndash; Евгений Рыжков<br /> Дизайн &ndash; Данил Гартман<br /> Front end &ndash; Дмитрий Чирва<br /> Back end &ndash; Сергей Бабанин<br /> Менеджмент и подготовка текстов &ndash; Инна Руденко<br /> Размещение контента &ndash; Александр Рыжков</p>', '<p>Разработать солидный сайт ориентированный на b2b сектор. Целями проекта были поставлены:</p>\r\n<ul>\r\n<li>подать компанию как современного партнера, соответствующего европейскому уровню обслуживания</li>\r\n<li>качественная подача предложений продукции</li>\r\n<li>яркое заявление и продажа сопутствующих услуг</li>\r\n</ul>', 'Лаконичный и строгий дизайн в сине-красных цветах подчеркивают серьезность и надежность компании, а промо блоки больших размеров – солидность и размах.', '', '', 'Оформление заказа делают более приятным небольшие анимации:', '', 'После 3-х месяцев работы и&nbsp;2-х итераций улучшений:', 'Тексан-Россия – эксклюзивный поставщик генераторов Teksan в России. Предлагает комплексные решения независимого энергообеспечения и надежное техническое обслуживание.', '<p>Лаконичный и строгий дизайн в сине-красных цветах подчеркивают серьезность и надежность компании, а промо блоки больших размеров &ndash; солидность и размах.</p>\r\n<p>Главная страница:</p>\r\n<p><img src="/frontend/web/p/source/1.jpg" alt="Это работа 1" width="900" height="2560" /></p>\r\n<p>Лаконичный и строгий дизайн в сине-красных цветах подчеркивают серьезность и надежность компании, а промо блоки больших размеров &ndash; солидность и размах.</p>\r\n<p>Оформление заказа делают более приятным небольшие анимации:</p>\r\n<p><img src="/frontend/web/p/source/2.jpg" alt="" width="768" height="491" /></p>\r\n<div class="align-center">&nbsp;</div>'),
(1, 'ua', 'Робота 1', '', 'Робота 1', 'Робота 1', '', '', '', 'Робота 1 - опис', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 'en', 'Work 2', '', 'Work 2', 'Work 2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 'ru', 'Работа 2', '', 'Работа 2', 'Работа 2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 'ua', 'Робота 2', '', 'Робота 2', 'Робота 2', '', '', '', 'Опис -2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 'en', 'Work 3', '', 'Work 3', 'Work 3', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 'ru', 'Работа 3', '', 'Работа 3', 'Работа 3', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 'ua', 'Робота 3', '', 'Робота 3', 'Робота 3', '', '', '', 'Опис-3', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 'en', 'Work 4', '', 'Work 4', 'Work 4', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 'ru', 'Работа 4', '', 'Работа 4', 'Работа 4', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 'ua', 'Работа 4', '', '', 'Работа 4', '', '', '', 'Работа-4', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 'en', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 'ru', 'Работа 5', '', '', 'Работа 5', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 'ua', 'Работа 5', '', '', 'Работа 5', '', '', '', 'Работа-5', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `works_resultlist1`
--

CREATE TABLE IF NOT EXISTS `works_resultlist1` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `idRel` int(3) unsigned NOT NULL COMMENT 'Id модуля',
  `lang` varchar(2) NOT NULL COMMENT 'Язык',
  `text` varchar(100) NOT NULL COMMENT 'Текст',
  PRIMARY KEY (`id`),
  KEY `idRel` (`idRel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=639 ;

--
-- Дамп данных таблицы `works_resultlist1`
--

INSERT INTO `works_resultlist1` (`id`, `idRel`, `lang`, `text`) VALUES
(412, 2, 'ru', ''),
(413, 2, 'ru', ''),
(414, 2, 'ru', ''),
(635, 1, 'ru', 'на                             <span>53%</span><b>снижен процент отказов</b>'),
(636, 1, 'ru', 'на                             <span>15.3%</span><b>увеличено число онлайн заявок</b>'),
(637, 1, 'ru', 'на                             <span>2.5 стр.</span><b>увеличина глубина просмотра</b>'),
(638, 1, 'ru', '');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `access_list`
--
ALTER TABLE `access_list`
  ADD CONSTRAINT `FK_access_list_user_id` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `claims_content`
--
ALTER TABLE `claims_content`
  ADD CONSTRAINT `claims_content_ibfk_1` FOREIGN KEY (`idClaims`) REFERENCES `claims` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_ibfk_1` FOREIGN KEY (`pageId`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `links_content`
--
ALTER TABLE `links_content`
  ADD CONSTRAINT `links_content_ibfk_1` FOREIGN KEY (`idLinks`) REFERENCES `links` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `pages_links`
--
ALTER TABLE `pages_links`
  ADD CONSTRAINT `pages_links_ibfk_1` FOREIGN KEY (`idPages`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pages_links_ibfk_2` FOREIGN KEY (`idLinks`) REFERENCES `links` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `works_content`
--
ALTER TABLE `works_content`
  ADD CONSTRAINT `works_content_ibfk_1` FOREIGN KEY (`idWorks`) REFERENCES `works` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
