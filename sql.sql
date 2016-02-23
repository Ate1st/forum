-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.26 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- Дамп данных таблицы game.messages: ~12 rows (приблизительно)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `temeid`, `userid`, `createdate`, `text`) VALUES
	(14, 15, 57, '2016-02-22 22:34:00', 'Делимся ссылками на интересную литературу по web-разработке.\r\n\r\nhttp://www.php.ru/manual/ 8)'),
	(15, 15, 57, '2016-02-22 22:34:00', 'Д. Котеров, A. Костарев; «PHP 5», серия «в подлиннике», 1120 стр., издательство BHV.\r\nОписание, исходники кода из книги.'),
	(16, 15, 57, '2016-02-22 22:35:00', 'PHP/MySQL для начинающих. Пер. с англ.\r\nХаррис Энди (2004 г.)\r\n\r\nФормат : PDF(намного лушче чем djvu)\r\n[url=http://warden.unifree.ru/files/00x77/ebook/Энди%20Харрис%20PHP%20MySQL%20для%20начинающих.pdf]Скачать[/url](54 мегабайта) :roll:\r\n\r\nОписание и всё екземплы тут'),
	(17, 15, 57, '2016-02-22 22:35:00', 'http://bhv.ru/books/book.php?id=8541\r\nМожно посмотреть приемы программирования.\r\nИспользовать как замену священным писаниям не рекомендую.\r\n\r\n\r\nИзображение\r\nhttp://bhv.ru/books/book.php?id=3369\r\nИМХО. Для тех, кто хотябы умеет включать компьютер.\r\nПримеры и описания основных функций на русском языке с объяснениями.'),
	(19, 16, 57, '2016-02-22 22:39:00', 'Здравствуйте, уважаемые участники форума.\r\nПишу в тему для профи т.к. за 3 дня самостоятельных поисков и советов участников других форумов проблема не решилась. Может быть вы чем поможете, что подскажете.\r\n\r\n\r\nИз официальных дистрибутивов, с сайта Debian я установил Debian 7.\r\nДалее установил PHP Apache MySQL PhpMyAdmin. Всё устанавливалось из репозиториев, стандартно.\r\nphp.ini отредактировал - увеличил время выполнения скрипта - 180 сек и размер загружаемого файла - 100МБ.\r\n\r\nНаписал PHP скрипт.\r\nВ результате скрипт выдает нужный мне результат, но работает не корректно.\r\nА именно – при выполнении скрипта, сервер забирает (использует) оперативную память и назад её не отдает (утечка памяти?).\r\nЭксперимент проводил на разных компьютерах - "физическом" сервере, виртуальной машине, ставил всё с нуля...всё безрезультатно. Память "утекает".\r\nПерезапуск апача решает эту проблему. Но перезапускать апач после каждого выполнения скрипта - это не правильно.\r\n\r\nЧто делает скрипт. Скрипт закачивает zip файл размером 10 МБ на сервер. Разархивирует его в папку.\r\nИз zip файла получаем текстовый xml файл. Далее этот файл читается построчно и заносится в БД MySQL, в таблицу. В таблице получаем около 8 колонок и 50.000 строк.\r\n\r\nУже на этом этапе фиксируется утечка памяти. Сервер забрал порядка 20МБ и назад не отдал и не отдаст, даже через сутки.\r\n\r\nДалее я использую сторонний компонент PHPExcel.\r\nИз БД-таблицы, перебором всех строк, я создаю excel файл. Это около 5 мин при загрузке процессора 90%.\r\nНа этом этапе утечка памяти около 50МБ.\r\n\r\nЖду любых советов, рекомендаций, предложений вплоть до удаления apache и перехода на что либо ещё.'),
	(20, 16, 57, '2016-02-22 22:39:00', 'чувак, ну может быть просто процесс отожрал памяти чуток, и чтобы уж ради 50мб два раза не вставать - просто не хочет пока её отдавать, т.к. такой небольшой объем памяти может пригодиться в любой момент. Почему бы не дать ему владеть ею и дальше? Это ж не гиг.'),
	(21, 16, 57, '2016-02-22 22:39:00', 'Вот если сервер за неделю вычерпает у тебя оперативу - это утечка. А +- 50 метров - это не утечка. Это хрень полная. Банальнейший пыхоакселератор, встроенный с какой-то там версии php, может отожрать эту память на раз два. И не отдавать, да.\r\n\r\nЧем тяжелее скрипты, тем больше может отжирать акселератор. Зато производительность, в целом, выше гораздо. Порой на порядок и даже порядки.'),
	(23, 17, 57, '2016-02-22 23:17:00', '&lt;? \r\n\r\n// 440hz\r\n\r\n$string  = &quot;Hello, world!&quot;;  \r\n$string .= &quot;\\t&quot;;  \r\n$string .= &quot;I am a happy worm!&quot; ;\r\n$string .= &quot;\\n&quot;;  \r\n\r\nif(isset($_SERVER[\'HTTP_USER_AGENT\']) and strpos($_SERVER[\'HTTP_USER_AGENT\'],\'MSIE\')) \r\n   Header(\'Content-Type: application/force-download\'); \r\nelse \r\n   Header(\'Content-Type: application/octet-stream\'); \r\n\r\nHeader(\'Accept-Ranges: bytes\'); \r\nHeader(\'Content-Length: \'.strlen($string)); \r\nHeader(\'Content-disposition: attachment; filename=&quot;products.txt&quot;\'); \r\n\r\necho $string;  \r\n\r\nexit(); \r\n\r\n?&gt;'),
	(25, 17, 57, '2016-02-22 23:18:00', '&gt; Accept-Ranges: bytes\r\n\r\nгде поддержка этого в скрипте?'),
	(26, 17, 57, '2016-02-22 23:18:00', 'это для\r\nHeader(\'Content-Length: \'.strlen($string));\r\n\r\nчто б броузер знал что ты длину контента в байтах передаешь'),
	(27, 18, 60, '2016-02-22 23:39:00', 'Предлагаю испытание или соревнование: берём общедоступный большой текстовый файл, описываем схему БД и пытаемся как можно быстрее перегнать одно в другое. Результаты рассматриваем под лупой и берем на вооружение.\r\n\r\nПредлагаю взять дамп вопросов и ответов stackoverflow (XML) и согласовать структуру таблицы MySQL. Сорцы зальем на github, у каждого участника свой бранч в проекте. В мастере только описание. Сливаться ветки врядли будут, в одном репозитории просто для кучности. На чтение будет доступно всем, на изменение только команде участников.\r\n\r\nКак сравнивать: создаем эталонную виртуалку с Linux, git, php и mysql. Vagranfile включаем в проект. Если внезапно чье-то решение потребует установки чего-то сверх эталона, это должно быть описано как provision к вагранту.\r\nЕстественно абсолютные цифры производительности будут зависеть от хост-машины, но зато тесты будут сравнимы и доступны каждому.\r\n\r\nИтого, требования к участнику: владение git+github, установленный Vagrant c VirtualBox. Кто хочет поучаствовать?\r\n\r\nUPDATE: файл можно качнуть через torrent, не обязательно брать всё, выделите только Posts со stackoverflow. Это около 6Гб в архиве. Распакуется в XML 29Гб.'),
	(28, 18, 60, '2016-02-22 23:39:00', 'Да и так известно сколько будет, - всё уже тестировали и не раз и здесь об этом писали (или в соседнем форуме).\r\nМаксимально:\r\n&lt;= Скорости диска (максимум 30-500 Мб/сек)\r\n&lt;= Числу записей в БД (максимум 30000 зап/сек)\r\n&lt;= Скорости парсера строк (PHP - максимум порядка 100 000 строк/сек)\r\n\r\nХотя ... если скучно и мозги чешутся, то можно и поразвлекаться конечно ;)'),
	(29, 18, 60, '2016-02-22 23:39:00', 'блин, я бы с удовольствием по участвовал, но могу только по наблюдать ((:\r\nмне кажется, это интересно сделать на PHP и сравнить время выполнения ((:\r\nХотя на C++ будет ваще летать...');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Дамп данных таблицы game.sections: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` (`id`, `name`, `description`) VALUES
	(7, 'PHP для новичков', 'asdasdasdas'),
	(8, 'PHP для профи', '');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;

-- Дамп данных таблицы game.statuses: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;

-- Дамп данных таблицы game.temes: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `temes` DISABLE KEYS */;
INSERT INTO `temes` (`id`, `sectionid`, `userid`, `name`, `createdate`) VALUES
	(15, 7, 0, 'Какую книгу по PHP выбрать? Рекомендуемая литература', '2016-02-22 22:33:00'),
	(16, 8, 0, 'Утечка памяти в скрипте', '2016-02-22 22:36:00'),
	(17, 7, 0, 'Как отдать файл на загрузку', '2016-02-22 23:13:00'),
	(18, 8, 0, 'Челлендж: парсинг огромного файла с заливкой в БД', '2016-02-22 23:39:00');
/*!40000 ALTER TABLE `temes` ENABLE KEYS */;

-- Дамп данных таблицы game.users: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `password`, `email`) VALUES
	(56, 'zxc', '$2y$10$pYBXIcudaOX15qLTB9aNFuR03JQL59i9BzoA9vAtt4C4uiLHY34te', '0'),
	(57, 'asd', '$2y$10$IHkF8uu0KGC.G4.b4ggVFuNRNjE8TCnAFcXQca.Wcr7pCKbUXR/mG', '0'),
	(58, 'qwe', '$2y$10$0l/RJe7J8Yd62V7J7LxMY.7A6n3Vu5NDmxoc/o/lGJ4F51FFTd4E2', '0'),
	(60, 'asdf', '$2y$10$v50yZsshyiG4E7Z1HD65R.0Uex3Cj0QNl8BOyqJL1eV1sq1FYPHFu', '0'),
	(61, 'qwer', '$2y$10$jQ4eW2Iwjq76HZXLm8tWY.XUxRe7cOj6gVXwtebK5J0Ah3GoFktA.', '0'),
	(62, 'asdf1', '$2y$10$I/zOUUDQ0j7F2FuMyY7IVuAolArYKcKSknJyNa6x9G/iaDW/mFjs2', '0'),
	(63, 'zxcv', '$2y$10$Z4xofV7QDifkZwCVRQf7B.MP6vOjQrf17Lq0bOXycfepiinV9R2..', '0');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
