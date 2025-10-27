-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 06:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `traveltrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `costsummary`
--

CREATE TABLE `costsummary` (
  `summary_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `historical_id` int(11) DEFAULT NULL,
  `transport_id` int(11) DEFAULT NULL,
  `total_cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `historicalplace`
--

CREATE TABLE `historicalplace` (
  `historical_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `ticket_price` decimal(10,2) DEFAULT 0.00,
  `map` varchar(512) DEFAULT NULL,
  `picture` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `historicalplace`
--

INSERT INTO `historicalplace` (`historical_id`, `place_id`, `name`, `description`, `ticket_price`, `map`, `picture`) VALUES
(33, 1, 'Ahsan Manzil', 'A historical palace museum located in Dhaka, showcasing the grandeur of the Nawab era.', 100.00, 'https://maps.app.goo.gl/scxPBEBwLxJr5sHA7', 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/14/16/b2/fe/ahsan-monjil.jpg?w=1200&h=-1&s=1'),
(34, 1, 'Lalbagh Fort', 'A Mughal fort in the heart of Dhaka, known for its beautiful architecture and rich history.', 50.00, 'https://maps.app.goo.gl/QJjnomE9dDwrPhsB6', 'https://www.travelandexplorebd.com/storage/app/public/posts/October2019/dreamstime_xxl_55742473.jpg'),
(35, 1, 'Jatiyo Sangsad Bhaban', 'The National Parliament House of Bangladesh, designed by architect Louis Kahn.', 0.00, 'https://maps.app.goo.gl/qqthrDX77DHtkQDd6', 'https://upload.wikimedia.org/wikipedia/commons/7/73/%E0%A6%AC%E0%A6%BE%E0%A6%82%E0%A6%B2%E0%A6%BE%E0%A6%A6%E0%A7%87%E0%A6%B6%E0%A7%87%E0%A6%B0_%E0%A6%9C%E0%A6%BE%E0%A6%A4%E0%A7%80%E0%A6%AF%E0%A6%BC_%E0%A6%B8%E0%A6%82%E0%A6%B8%E0%A6%A6_%E0%A6%AD%E0%A6%AC%E0%A6%A8_16.jpg'),
(36, 1, 'Sonargaon', 'An ancient city and capital of Bengal during the medieval period, known for its historical buildings and folk art.', 150.00, 'https://maps.app.goo.gl/bPg3zBoGrbye5Wcj7', 'https://www.aiub.edu/Files/Uploads/original/panamatouraiub07.jpg'),
(37, 1, 'Bangladesh National Museum', 'A large museum in Dhaka featuring collections of archaeology, art, and ethnology.', 20.00, 'https://maps.app.goo.gl/QNvhaT3TJW1j7WF1A', 'https://lh5.googleusercontent.com/proxy/_2kX9FLzD19tIQHGtPHEZI9yf0kWVNJOnOFHGtFzjL4bGnlyaBkbGtMOn2f7Neve3d9N-b-Ul07jNldh2kHoIrY3tqHRoTneP6UPU-KrBytOiEYewFyWCKvhJq1SdJAipILZtaPgOf9L6gAzS2WtlmH2sPQwJJO1qeDT9jYJTZGv8XYn'),
(38, 2, 'Cox’s Bazar Sea Beach', 'The longest natural sandy sea beach in the world, famous for its beauty and peaceful atmosphere.', 200.00, 'https://maps.app.goo.gl/6K78uhQpKh3tW7mr8', 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/10/e2/f8/43/longest-sea-beach-in.jpg?w=1100&h=1100&s=1'),
(39, 2, 'Patenga Beach', 'A popular tourist beach located near the port city of Chattogram, known for its sunset views.', 100.00, 'https://maps.app.goo.gl/aNhVCDZgSuuMBmtz8', 'https://www.travelmate.com.bd/wp-content/uploads/2019/08/patenga-sea-beach-2.jpg'),
(40, 2, 'Foy’s Lake', 'A man-made lake in Chattogram, popular for boat rides and surrounded by lush greenery.', 50.00, 'https://maps.app.goo.gl/GEEgggwV2rTyoo7A6', 'https://www.amazingtoursbd.com/tour_image/foys-lake-is-a-man-made-lake-in-chittagong.jpg'),
(41, 2, 'Kaptai Lake', 'A scenic reservoir surrounded by hills, located in the Kaptai National Park.', 50.00, 'https://maps.app.goo.gl/MXKLvi1HchrpKmX47', 'https://upload.wikimedia.org/wikipedia/commons/0/01/Kaptai_Lake_05.jpg'),
(42, 2, 'Chandranath Temple', 'A significant Hindu temple in Chattogram with rich cultural and religious history.', 30.00, 'https://maps.app.goo.gl/oMNVUNZkijRVALtJ7', 'https://pbs.twimg.com/media/GCiC-rkWQAEzc9T.jpg'),
(43, 4, 'Mahasthangarh', 'An ancient archaeological site in Bogura, known for its ruins dating back to the Maurya period.', 150.00, 'https://maps.app.goo.gl/coWQq35iqTeNUhy29', 'https://farm8.staticflickr.com/7620/27715467586_81cf9c0141_b.jpg'),
(44, 4, 'Paharpur Buddhist Monastery', 'A UNESCO World Heritage site, an ancient Buddhist monastery dating back to the 8th century.', 200.00, 'https://maps.app.goo.gl/cNsLyS2UexGXswBH8', 'https://upload.wikimedia.org/wikipedia/commons/4/42/Paharpur_Buddhist_Bihar.jpg'),
(45, 4, 'Varendra Research Museum', 'A museum in Rajshahi showcasing archaeological artifacts from ancient Bengal.', 50.00, 'https://goo.gl/maps/YxDiAVBoNRPjAZji8', 'https://www.ru.ac.bd/wp-content/uploads/2022/06/Varendra-Research-Museum.jpg'),
(46, 4, 'Godagari River', 'A river flowing near Rajshahi, famous for its peaceful surroundings and historical significance.', 0.00, 'https://maps.app.goo.gl/tqJ1egCXgGhr4apo7', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTGWqWyqVGpkCQ8Umn8JoWwjg8hGqHY4va27w&s'),
(47, 3, 'Bagerhat 60 Dome Mosque', 'A historical mosque in Bagerhat, part of the UNESCO World Heritage site.', 100.00, 'https://maps.app.goo.gl/fwY6RU8dVzaFoSwp6', 'https://upload.wikimedia.org/wikipedia/commons/4/4f/Sixty_Dome_Mosque%2CBagerhat.jpg'),
(48, 3, 'Sundarbans', 'The largest mangrove forest in the world, home to the Bengal tiger and other wildlife.', 0.00, 'https://maps.app.goo.gl/Xe76z7KvccCJKvot5', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/23/Sundarban_Tiger.jpg/800px-Sundarban_Tiger.jpg'),
(49, 5, 'Kuakata Sea Beach', 'A scenic beach in the southern part of Bangladesh, offering both sunrise and sunset views.', 300.00, 'https://maps.app.goo.gl/uFxi42MLKJqpz3An9', 'https://upload.wikimedia.org/wikipedia/commons/c/ca/Kuakata_sea_beach_evening.jpg'),
(50, 3, 'Shilaidaha Kuthibari', 'A historic residence of Rabindranath Tagore located in Kumarkhali, known for its cultural significance.', 50.00, 'https://maps.app.goo.gl/BHndc95FrYpKEE9HA', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Shilaidaha_Rabindra_Kuthibadi._5.jpg/800px-Shilaidaha_Rabindra_Kuthibadi._5.jpg'),
(52, 3, 'Khan Jahan Ali Tomb', 'A historical tomb in Bagerhat, dedicated to the Muslim saint Khan Jahan Ali.', 50.00, 'https://maps.app.goo.gl/dtgkNQVU2YtW8sWR9', 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3e/Tomb_of_Khan_Jahan_Ali_%28113%29.jpg/1200px-Tomb_of_Khan_Jahan_Ali_%28113%29.jpg'),
(54, 5, 'Bibi Chini Mosque', 'Ancient mosques in Barguna, known for their architectural beauty and cultural importance.', 50.00, 'https://maps.app.goo.gl/u2tje7Gb6q9Ueein9', 'https://upload.wikimedia.org/wikipedia/commons/7/78/%E0%A6%AC%E0%A6%BF%E0%A6%AC%E0%A6%BF_%E0%A6%9A%E0%A6%BF%E0%A6%A8%E0%A6%BF_%E0%A6%B6%E0%A6%BE%E0%A6%B9%E0%A7%80_%E0%A6%AE%E0%A6%B8%E0%A6%9C%E0%A6%BF%E0%A6%A6.jpg'),
(55, 5, 'Lebur Char', 'An island in Barishal, known for its unique landscape and cultural heritage.', 0.00, 'https://maps.app.goo.gl/T6648H5uj4A9vR1z7', 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/10/1a/a6/a2/img-1061-largejpg.jpg?w=1200&h=-1&s=1'),
(56, 5, 'Durga Sagar', 'A historical pond in Barishal associated with Hindu religious practices and rituals.', 20.00, 'https://maps.app.goo.gl/EVMGCLopjcoqHRdw5', 'https://upload.wikimedia.org/wikipedia/commons/6/65/%E0%A6%A6%E0%A7%81%E0%A6%B0%E0%A7%8D%E0%A6%97%E0%A6%BE%E0%A6%B8%E0%A6%BE%E0%A6%97%E0%A6%B0.JPG'),
(57, 5, 'Chandradwip', 'A small island in Barishal, known for its serene beauty and local cultural practices.', 0.00, NULL, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyl6nrUNg8ArSKvuT651JOuztSSS8HKec6OQ&s'),
(58, 6, 'Srimangal', 'Known as the tea capital of Bangladesh, famous for its vast tea gardens and natural beauty.', 0.00, 'https://maps.app.goo.gl/fvdzbdyG7SPgYGgu9', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT2sIriIkHwBR-3xfYJdemlM0ZWPpPFqQZodQ&s'),
(59, 6, 'Jaflong', 'A scenic area in Sylhet, known for its hills, tea estates, and waterfalls.', 50.00, 'https://maps.app.goo.gl/yTfADGyrykLCghnDA', 'https://travelsetu.com/apps/uploads/new_destinations_photos/destination/2024/06/29/d7e566961bf746a9dc2f24efa4873e44_1000x1000.jpg'),
(60, 6, 'Ratargul Swamp Forest', 'A freshwater swamp forest in Gowainghat, one of the only swamp forests in Bangladesh.', 200.00, 'https://maps.app.goo.gl/AC1e9tZ8HEqs13WP9', 'https://www.travelandexplorebd.com/storage/app/public/posts/April2020/Ratargul%20Swamp%20Forest,%20Sylhet2.jpg'),
(61, 6, 'Shahjalal University of Science and Technology (SUST)', 'An important educational institution in Bangladesh, known for its historical significance in the education sector.', 0.00, 'https://maps.app.goo.gl/BBnF55aHN4mnf53C7', 'https://admin.sust.edu/public/uploads/website/basicConfiguration/overview/upload_photo/63187f4bb938a_170.jpg'),
(62, 6, 'Shah Paran Mazar Sharif', 'The tomb of Hazrat Shah Paran in Sylhet, a revered Islamic saint.', 100.00, 'https://maps.app.goo.gl/LiN8726wCnW2dnCY8', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRvofT7VRI_kGj-lb5BKLGJWJ60XvEdLb25RQ&s'),
(63, 7, 'Kantajew Temple', 'An ancient Hindu temple in Dinajpur, famous for its terracotta architecture.', 150.00, 'https://maps.app.goo.gl/FyvY1TXd6eGpqsCE8', 'https://upload.wikimedia.org/wikipedia/commons/0/06/Kantaji_Temple_Dinajpur_Bangladesh_%2812%29.JPG'),
(64, 7, 'Dinajpur Rajbari', 'A historic palace in Dinajpur, reflecting the grandeur of the zamindar era.', 100.00, 'https://maps.app.goo.gl/Gotcigtnyrj1p9XH8', 'https://vromonguide.com/wp-content/uploads/Dinajpur-Rajbari.jpg'),
(65, 7, 'Goyanda', 'A historic site in Rangpur with archaeological significance dating back to the Buddhist period.', 50.00, NULL, NULL),
(66, 7, 'Teesta Barrage', 'A large irrigation project located in Rangpur, providing water for agriculture.', 0.00, 'https://maps.app.goo.gl/HcecU7ZRgYeBARcf7', 'https://upload.wikimedia.org/wikipedia/commons/9/98/Teesta_Barrage_Bangladesh.jpg'),
(67, 7, 'Pirgachha', 'A historic place in Rangpur with historical monuments and natural beauty.', 50.00, 'https://maps.app.goo.gl/iZQd8FfyZETHF8XJ6', 'https://vromonguide.com/wp-content/uploads/Pirgacha-Rubber-Bagan-Tangail-770x420.jpg'),
(68, 6, 'Madhabkunda Waterfall', 'The largest waterfall in Bangladesh, located in the Sylhet region.', 0.00, 'https://maps.app.goo.gl/hzbVf2LaQC3VCmUf8', 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/13/41/50/04/it-is-situated-in-barlekha.jpg?w=1200&h=-1&s=1'),
(69, 8, 'Brahmaputra River', 'A river that flows through Mymensingh, offering scenic views and opportunities for boating.', 0.00, 'https://maps.app.goo.gl/5bp8gx3CNH4HSeTEA', 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Brahmaputra_River_Homeward_bound.jpg/1200px-Brahmaputra_River_Homeward_bound.jpg'),
(70, 8, 'Muktagacha Rajbari', 'A historic palace of a prominent zamindar family, located in Mymensingh.', 50.00, 'https://maps.app.goo.gl/fJc2Nom4giKv7qav7', 'https://www.touristplaces.com.bd/images/pp/6/p120930kir.jpg'),
(72, 8, 'Sree Sree Ramakrishna Ashram', 'A prominent religious site in Mymensingh for spiritual retreats.', 20.00, 'https://maps.app.goo.gl/qR31bFcEjWhrpou8A', 'https://live.staticflickr.com/65535/54019998932_49999b7dfe_k.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotel_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `hotel_name` varchar(100) NOT NULL,
  `stars` int(11) DEFAULT NULL CHECK (`stars` between 1 and 5),
  `avg_price` decimal(10,2) NOT NULL,
  `maps` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_id`, `place_id`, `hotel_name`, `stars`, `avg_price`, `maps`) VALUES
(49, 1, 'Pan Pacific Sonargaon Dhaka', 5, 2200.00, NULL),
(50, 1, 'Hotel Purbani International', 4, 1600.00, NULL),
(51, 1, 'The Westin Dhaka', 5, 4000.00, NULL),
(52, 1, 'Lalbagh Hotel', 3, 1600.00, NULL),
(53, 2, 'Radisson Blu Chattogram Bay View', 5, 1500.00, NULL),
(54, 2, 'The Peninsula Chittagong', 4, 1600.00, NULL),
(55, 2, 'Hotel Agrabad', 3, 1500.00, NULL),
(56, 2, 'Royal International Hotel', 3, 1500.00, NULL),
(57, 3, 'Hotel Ruppo', 4, 1600.00, NULL),
(58, 3, 'Ambala Inn', 3, 1500.00, NULL),
(59, 3, 'Zam Zam Hotel', 3, 1500.00, NULL),
(60, 3, 'Renaissance Rajshahi', 5, 1800.00, NULL),
(61, 4, 'The Royal Hotel', 5, 1600.00, NULL),
(62, 4, 'Hotel Sundarbans', 4, 1500.00, NULL),
(63, 4, 'Nice Palace Hotel', 3, 1500.00, NULL),
(64, 4, 'Hotel Western Inn', 3, 1500.00, NULL),
(65, 5, 'Grand Sylhet Hotel & Resort', 5, 2000.00, NULL),
(66, 5, 'Hotel Green View', 3, 1500.00, NULL),
(67, 5, 'Hotel Miraz', 4, 1500.00, NULL),
(68, 5, 'Hotel East Inn', 3, 1500.00, NULL),
(69, 6, 'The Grand Sylhet', 5, 2000.00, NULL),
(70, 6, 'Hotel Naz', 3, 1500.00, NULL),
(71, 6, 'Hotel Dream Inn', 4, 1600.00, NULL),
(72, 6, 'Hotel Shanti', 3, 1500.00, NULL),
(73, 7, 'Sundarban Hotel', 4, 1500.00, NULL),
(74, 7, 'Hotel Sundarbans Palace', 3, 1500.00, NULL),
(75, 7, 'Hotel Rangpur', 3, 1500.00, NULL),
(76, 7, 'Khan Hotel', 2, 1500.00, NULL),
(77, 8, 'The Grand Mymensingh', 5, 1600.00, NULL),
(78, 8, 'Hotel Akash', 3, 1500.00, NULL),
(79, 8, 'Hotel Mymensingh Inn', 4, 1500.00, NULL),
(80, 8, 'Hotel River View', 3, 1500.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE `place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(50) NOT NULL,
  `best_season` varchar(20) NOT NULL,
  `place_pic` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`place_id`, `place_name`, `best_season`, `place_pic`) VALUES
(1, 'Dhaka', 'Spring', 'https://t3.ftcdn.net/jpg/04/31/79/70/360_F_431797063_tUEOKpIXpBH3cG6Gx0xkE73bEiwgC3Qv.jpg\r\n'),
(2, 'Chattogram', 'Winter', 'https://media.tacdn.com/media/attractions-splice-spp-674x446/09/ca/4c/d3.jpg'),
(3, 'Khulna', 'Late Autumn', 'https://media.istockphoto.com/id/1756704640/photo/a-canal-in-sundarbans-world-largest-mangrove-forest-bangladesh.jpg?s=612x612&w=0&k=20&c=715Wevy9Tx-UoK6UGPSy4DAOP9cRdUkaC3s4g-IsK-8='),
(4, 'Rajshahi', 'Summer', 'https://preview.redd.it/rajshahi-city-bangladesh-v0-r4vvqh3860hc1.png?width=1048&format=png&auto=webp&s=768279beaf1e378674ea08c2648bcf892bdc3612'),
(5, 'Barisal', 'Winter', 'https://upload.wikimedia.org/wikipedia/commons/7/78/Barisal_Launch_Terninal.jpg'),
(6, 'Sylhet', 'Autumn', 'https://t4.ftcdn.net/jpg/09/45/22/09/360_F_945220926_nGk0rs2r3V9EUj9TFWN9ifg8eXbehRPo.jpg'),
(7, 'Rangpur', 'Summer', 'https://c8.alamy.com/zooms/9/ce0b35997027422a95374f0d18892d8d/jax9k3.jpg'),
(8, 'Mymensingh', 'Winter', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/%E0%A6%B6%E0%A6%B6%E0%A7%80_%E0%A6%B2%E0%A6%9C_%28%E0%A7%A6%E0%A7%A8%29.jpg/1200px-%E0%A6%B6%E0%A6%B6%E0%A7%80_%E0%A6%B2%E0%A6%9C_%28%E0%A7%A6%E0%A7%A8%29.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `user_id`, `place_id`, `rating`, `comment`) VALUES
(14, 19, 2, 5, 'good'),
(15, 20, 8, 3, 'good good '),
(16, 19, 1, 5, 'urhkbrtrtv');

-- --------------------------------------------------------

--
-- Table structure for table `transportation`
--

CREATE TABLE `transportation` (
  `transport_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transportation`
--

INSERT INTO `transportation` (`transport_id`, `place_id`, `type`, `cost`) VALUES
(1, 1, 'Bus', 500.00),
(2, 1, 'Train', 300.00),
(3, 1, 'Car', 2000.00),
(4, 2, 'Bus', 700.00),
(5, 2, 'Train', 500.00),
(6, 2, 'Airplane', 4000.00),
(7, 3, 'Bus', 800.00),
(8, 3, 'Train', 600.00),
(9, 3, 'Car', 2500.00),
(10, 4, 'Bus', 700.00),
(11, 4, 'Train', 450.00),
(12, 4, 'Car', 2200.00),
(13, 5, 'Bus', 750.00),
(14, 5, 'Car', 2100.00),
(15, 6, 'Bus', 850.00),
(16, 6, 'Train', 500.00),
(17, 6, 'Airplane', 5000.00),
(18, 7, 'Bus', 800.00),
(19, 7, 'Train', 500.00),
(20, 8, 'Bus', 750.00),
(21, 8, 'Car', 2300.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `favword` varchar(156) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `FirstName`, `email`, `password`, `username`, `favword`, `LastName`) VALUES
(19, 'ayman', 'ayman.muntasir@g.bracu.ac.bd', '12345', 'ayman', 'cars', 'muntasir'),
(20, 'ridwan', 'ridwanbinmasum@gmail.com', '123', 'ridwan', 'ridwan', 'bin masum');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `transport_id` int(11) DEFAULT NULL,
  `historical_ids` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `user_id`, `place_id`, `hotel_id`, `transport_id`, `historical_ids`) VALUES
(48, 19, 2, 53, 6, '38,39,40,41,42'),
(49, 20, 2, 53, 6, '38,39,40,41,42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `costsummary`
--
ALTER TABLE `costsummary`
  ADD PRIMARY KEY (`summary_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `historical_id` (`historical_id`),
  ADD KEY `transport_id` (`transport_id`);

--
-- Indexes for table `historicalplace`
--
ALTER TABLE `historicalplace`
  ADD PRIMARY KEY (`historical_id`),
  ADD KEY `place_id` (`place_id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotel_id`),
  ADD KEY `place_id` (`place_id`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `place_id` (`place_id`);

--
-- Indexes for table `transportation`
--
ALTER TABLE `transportation`
  ADD PRIMARY KEY (`transport_id`),
  ADD KEY `place_id` (`place_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `place_id` (`place_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `costsummary`
--
ALTER TABLE `costsummary`
  MODIFY `summary_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `historicalplace`
--
ALTER TABLE `historicalplace`
  MODIFY `historical_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `transportation`
--
ALTER TABLE `transportation`
  MODIFY `transport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `costsummary`
--
ALTER TABLE `costsummary`
  ADD CONSTRAINT `costsummary_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `costsummary_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`),
  ADD CONSTRAINT `costsummary_ibfk_3` FOREIGN KEY (`historical_id`) REFERENCES `historicalplace` (`historical_id`),
  ADD CONSTRAINT `costsummary_ibfk_4` FOREIGN KEY (`transport_id`) REFERENCES `transportation` (`transport_id`);

--
-- Constraints for table `historicalplace`
--
ALTER TABLE `historicalplace`
  ADD CONSTRAINT `historicalplace_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `place` (`place_id`);

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `hotel_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `place` (`place_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`place_id`) REFERENCES `place` (`place_id`);

--
-- Constraints for table `transportation`
--
ALTER TABLE `transportation`
  ADD CONSTRAINT `transportation_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `place` (`place_id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`place_id`) REFERENCES `place` (`place_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
