INSERT INTO `office` (`office_id`, `country`, `city`) VALUES
(1, 'Netherlands', 'Zierikzee'),
(2, 'India', 'Delhi'),
(3, 'Norway', 'Grimstad'),
(4, 'Germany', 'Mannheim'),
(5, 'Sweden', 'Lerum');

INSERT INTO `car` (`plate_id`, `model`, `body`, `brand`, `color`, `year`, `status`, `office_id`) VALUES
(6283, 'grandland', 'suv', 'opel', 'black', 2005, 'active', 1),
(9677, 'passat', 'sedan', 'volkswagen', 'silver', 2009, 'active', 1),
(6384, 'ateca', 'suv', 'seat', 'black', 2022, 'out of service', 1),
(2453, 'optra', 'sedan', 'chevrolet', 'gray', 2017, 'active', 2),
(8765, 'b180', 'hatchback', 'mercedes', 'gray', 2011, 'active', 2),
(9712, 'x3', 'suv', 'bmw', 'gray', 2009, 'active', 3),
(8419, '500x', 'suv', 'fiat', 'white', 2021, 'active', 3),
(9972, 'kadiaq', 'suv', 'skoda', 'white', 2015, 'active', 3),
(4850, 'lanos', 'sedan', 'chevrolet', 'blue', 2021, 'active', 4),
(8599, '508', 'sedan', 'peugeot', 'silver', 2007, 'active', 5),
(5796, '508', 'sedan', 'peugeot', 'blue', 2006, 'active', 5),
(5682, 'q3', 'suv', 'audi', 'gray', 2021, 'active', 5),
(8459, '500x', 'suv', 'fiat', 'blue', 2014, 'active', 5),
(8755, 'a3', 'sedan', 'audi', 'white', 2017, 'active', 5);

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `password`, `email`, `birthdate`, `gender`, `country`, `city`, `is_admin`) VALUES
(1, 'Paki', 'Cairo', 'm617p6', 'p.cairo@hotmail.com', '1961-08-21', "", 'Canada', 'Mundare', FALSE),
(2, 'Amery', 'Hammett', '2fnf9e', 'a.hammett4143@hotmail.com', '1974-08-03', 'F', 'Chile', 'Florida', FALSE),
(3, 'Stuart', 'Walker', 'c0hg2m', 'walker-stuart@outlook.com', '1961-04-17', 'M', 'United Kingdom', 'Watford', FALSE),
(4, 'Stone', 'Tanner', 'p40dlb', 'tannerstone@yahoo.com', '1962-01-17', 'M', 'Netherlands', 'Rotem', FALSE),
(5, 'Lee', 'Simon', '17dn92', 's_lee@yahoo.com', '1976-08-10', 'F', 'China', 'Hong Kong', FALSE),
(6, 'Rowan', 'Merrill', 'wcmt6b', 'merrill_rowan1862@outlook.com', '1971-05-07', 'F', 'Ireland', 'Belfast', FALSE),
(7, 'Shaeleigh', 'Caleb', 'x5aab2', 'caleb-shaeleigh@hotmail.com', '1981-07-09', 'M', 'India', 'Mumbai', FALSE),
(8, 'Isabelle', 'Forrest', 'qq8sta', 'iforrest@gmail.com', '1980-11-18', 'F', 'Nigeria', 'Lagos', FALSE),
(9, 'Arthur', 'Silas', 'y56cfw', 'a_silas957@outlook.com', '1974-08-03', 'M', 'Italy', 'Empoli', FALSE),
(10, 'Alana', 'Wade', 'cdnc5m', 'wadealana@gmail.com', '1979-07-14', 'F', 'New Zealand', 'Levin', FALSE),
(11, 'Blaze', 'Alec', '6fm9y2', 'ablaze9300@outlook.com', '1998-01-15', 'M', 'Peru', 'Iquitos', FALSE),
(12, 'Avye', 'Barclay', 'qaqs1k', 'barclayavye6981@yahoo.com', '1988-05-07', "", 'Colombia', 'Saravena', FALSE),
(13, 'Fiona', 'Jarrod', '8vdmq8', 'jfiona3989@gmail.com', '1996-04-21', 'F', 'Austria', 'Telfs', FALSE),
(14, 'Adena', 'Baxter', '69tu4t', 'adena.baxter@outlook.com', '1981-05-12', 'F', 'Ireland', 'Dublin', FALSE),
(15, 'Norman', 'Alec', 'lr2i97', 'alec.norman2131@yahoo.com', '1966-03-02', 'M', 'Pakistan', 'Kotli', FALSE),
(16, 'Jackson', 'Oleg', 'xsu986', 'joleg4886@hotmail.com', '1973-05-17', 'M', 'Norway', 'Grimstad', FALSE),
(17, 'admin', 'admin', 'dv3o77', 'carrentalsystem@gmail.com', '2000-01-01', "", 'Egypt', 'Alexandria', TRUE);

INSERT INTO `reservation` (`reservation_id`, `user_id`, `plate_id`, `office_id`, `reservation_date`, `paid`) VALUES
(1, 4, 8459, 5, '2021-08-03', TRUE);