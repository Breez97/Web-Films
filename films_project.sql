-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 09 2023 г., 21:05
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `films_project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments_and_ratings`
--

CREATE TABLE `comments_and_ratings` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `film_id` int NOT NULL,
  `comment` text NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `comments_and_ratings`
--

INSERT INTO `comments_and_ratings` (`id`, `user_id`, `film_id`, `comment`, `rating`) VALUES
(1, 2, 1, '', 7),
(2, 3, 1, '', 8),
(3, 5, 2, '', 6.5),
(4, 7, 2, '', 8.2),
(5, 2, 3, '', 4),
(6, 3, 3, '', 7),
(7, 6, 4, '', 7.8),
(8, 8, 5, '', 8),
(9, 7, 5, '', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `favourites`
--

CREATE TABLE `favourites` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `film_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `film_id`) VALUES
(12, 2, 5),
(13, 1, 2),
(14, 1, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `films`
--

CREATE TABLE `films` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `header_image` varchar(255) NOT NULL,
  `small_image` varchar(255) NOT NULL,
  `rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `films`
--

INSERT INTO `films` (`id`, `title`, `category`, `header_image`, `small_image`, `rating`) VALUES
(1, 'Главный герой', 'film', 'films_images/header_images/good_guy.png', 'films_images/small_images/good_guy_small.png', 7.5),
(2, 'Бегущий по лезвию', 'film', 'films_images/header_images/bladerunner.png', 'films_images/small_images/bladerunner_small.png', 7.4),
(3, 'Оппенгеймер', 'film', 'films_images/header_images/oppenheimer.png', 'films_images/small_images/oppenheimer_small.png', 5.5),
(4, 'Начало', 'film', 'films_images/header_images/beginning.png', 'films_images/small_images/beginning_small.png', 7.8),
(5, '1 + 1', 'film', 'films_images/header_images/one_plus_one.png', 'films_images/small_images/one_plus_one_small.png', 8.5);

-- --------------------------------------------------------

--
-- Структура таблицы `films_info`
--

CREATE TABLE `films_info` (
  `id` int NOT NULL,
  `film_id` int NOT NULL,
  `desription` text NOT NULL,
  `genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `films_info`
--

INSERT INTO `films_info` (`id`, `film_id`, `desription`, `genre`) VALUES
(1, 1, '\"Главный герой\" - захватывающий триллер, переплетающий виртуальную реальность и реальную жизнь. Парень, не подозревая о своем статусе неигрового персонажа, сталкивается с тем, что мир вокруг него - всего лишь видеоигра. В поисках правды Милли Раск, разработчик исходного кода, вводит его в реальность, разрушая границы между виртуалом и реальностью. Парень, влюбляясь в Molotov Girl, начинает выходить за пределы своего программированного сценария, становясь героем в собственной истории. Загадки, заговоры и неожиданные повороты создают динамичный сюжет, а персонажи оживают, претворяясь в жизнь на экране.\r\nФильм исследует темы искусственного интеллекта, свободы внутри игровых миров и реальной силы эмоций. Смешение жанров, от триллера до романтики, придает ему уникальность, а впечатляющие визуальные эффекты дополняют захватывающий научно-фантастический нарратив. \"Главный герой\" — это захватывающее кино о поиске истинной сущности, свободе выбора и возможности изменить свой сценарий в борьбе против корпоративного заговора.', 'мелодрама, комедия, боевик, фантастика'),
(2, 2, 'В 2049 году, спустя 30 лет после \"Бегущего по лезвию\", репликант-охотник Кей (Райан Гослинг) ищет ребёнка, рождённого репликантом, что может изменить баланс сил. Проводя расследование, он обнаруживает, что репликанты могут размножаться естественным путём. В поисках ответов, Кей выходит на Рика Декарда (Харрисон Форд), сталкивается с мегакорпорацией \"Уоллес\" и узнаёт о своём искусственном происхождении.\r\nКей также обнаруживает, что воспоминание о детстве — настоящее, и он является ребёнком Рейчел и Декарда. После серии событий, включая похищение Декарда и гибель его подруги Джой, Кей сближается с группой репликантов, борющихся за свободу.\r\nВ финале Кей спасает Декарда и встречается с дочерью создателя воспоминаний Аны Стеллин. В своей судьбоносной схватке с репликантом Лав, Кей получает тяжёлые ранения и, предположительно, умирает. Декард встречается со своей дочерью, раскрывая своё человеческое происхождение.', 'фантастика, боевик, триллер, драма'),
(3, 3, 'Роберт Оппенгеймер, блестящий физик, возвращается в США после обучения в Германии. Под влиянием Лоуренса и Пьюнинг, он принимает предложение полковника Гровса присоединиться к проекту атомной бомбы. Он собирает команду для создания бомбы, стремясь использовать её для предотвращения войны.\r\nВ период тестирования \"Тринити\" возникают опасения, но испытание проходит успешно. В это время его близкая подруга Тэтлок умирает, предположительно, от самоубийства. В конце Второй мировой войны, президент Трумэн решает сбросить атомные бомбы на Хиросиму и Нагасаки.\r\nОппенгеймер встречается с Трумэном, испытывая угрызения совести. В последующие годы он становится противником ядерных разработок, но его связи с коммунистами и роман с Тэтлок приводят к аннулированию его допуска к секретной информации. Оппенгеймер подаёт жалобу, что в конечном итоге наносит ущерб репутации Штраусса.', 'история, драма, биография'),
(4, 4, 'Доминик Кобб и его команда специализируются на корпоративном шпионаже, используя технологию совместного сновидения. Сайто предлагает Коббу задачу: внедрить идею в подсознание наследника конкурента. В обмен на выполнение задачи, Кобб получит возможность вернуться в США, где его обвиняют в убийстве жены. Команда включает Имса, Юсуфа и Ариадну.\r\nКобб объясняет, что летая в мире снов с покойной женой Мэл, они провели десятилетия в лимбе. Пытаясь вернуть Мэл, он использовал её тотем, что привело к её самоубийству и обвинению Кобба. Теперь он хочет вернуться к своим детям.\r\nКоманда погружается в сновидение Роберта Фишера, где каждый уровень представляет разные реальности. В ходе задачи возникают проблемы, включая проекции и прошлые травмы Кобба. Команда сталкивается с ловушками, проекциями и внутренними конфликтами.\r\nНа каждом уровне снов происходят выбросы, синхронизированные с аудиосигналом. В конечном итоге, задача завершается, и Кобб возвращается в США, но он решает проверить реальность, используя тотем.\r\nСценарий заканчивается с возвращением Кобба к своим детям, но оставляет открытым вопрос о том, реальный ли этот мир или всё ещё часть сновидения.', 'фантастика, боевик, триллер, драма, детектив'),
(5, 5, 'Филипп, парализованный богатый аристократ, ищет помощника и нанимает Дрисса, чернокожего с криминальным прошлым. Несмотря на различия, между ними завязывается крепкая дружба. Дрисс узнаёт о подруге Филиппа и уговаривает его связаться с ней, но Филипп пугается и меняет фотографии. В итоге они встречаются, но Филипп передумывает и не заходит в ресторан. Позже Дрисс временно уходит, но Филипп не может без него и радуется его возвращению. Они проводят время вместе, и Дрисс представляет Филиппу Элеонору. В итоге оба главных персонажа находят счастье: Филипп переехал и обзавёлся семьёй, а Дрисс открыл свой бизнес и также имеет семью. Они остаются друзьями и по сей день.', 'драма, комедия, биография');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `password`, `email`) VALUES
(1, 'Админ', 'root', 'root123', 'root@gmail.com'),
(2, 'Максим Сидоров', 'max_s', 'max123', 'max.sidorov@mail.com'),
(3, 'Александр Иванов', 'sanya_1', 'sanya123', 'alexandr.ivanov@gmail.com'),
(5, 'Дарина Лебедева', 'DarinaLeb', 'darina_leb', 'darina.lebedeva'),
(6, 'Илья Шамров', 'ilya_shamrov', 'ilya123', 'ilya66401@gmail.com'),
(7, 'Николай Козлов', 'nick_kozlov', 'Tiger123', 'nick_kozlov@mail.com'),
(8, 'Игорь Семенов', 'igor_semen', 'Star789', 'igor_semen@gmail.com');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments_and_ratings`
--
ALTER TABLE `comments_and_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `films_info`
--
ALTER TABLE `films_info`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments_and_ratings`
--
ALTER TABLE `comments_and_ratings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `films`
--
ALTER TABLE `films`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `films_info`
--
ALTER TABLE `films_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
