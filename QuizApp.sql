create DATABASE QuizApp;
USE QuizApp;

CREATE TABLE admins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    school VARCHAR(255) NOT NULL
);

ALTER TABLE students ADD COLUMN score INT DEFAULT 0;

CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    option_a VARCHAR(100),
    option_b VARCHAR(100),
    option_c VARCHAR(100),
    option_d VARCHAR(100),
    correct_option CHAR(1)
);

-- Insert Astronomy questions
INSERT INTO questions (question, option_a, option_b, option_c, option_d, correct_option) VALUES
('What is the largest planet in our solar system?', 'Earth', 'Mars', 'Jupiter', 'Saturn', 'C'),
('Which planet is known as the Red Planet?', 'Venus', 'Mars', 'Mercury', 'Jupiter', 'B'),
('What is the closest star to Earth?', 'Alpha Centauri', 'Sirius', 'The Sun', 'Proxima Centauri', 'C'),
('What galaxy do we live in?', 'Andromeda Galaxy', 'Whirlpool Galaxy', 'Milky Way Galaxy', 'Sombrero Galaxy', 'C'),
('What is the name of the first man to walk on the moon?', 'Buzz Aldrin', 'Neil Armstrong', 'Yuri Gagarin', 'Alan Shepard', 'B'),
('What force keeps the planets in orbit around the Sun?', 'Magnetism', 'Gravity', 'Centrifugal Force', 'Friction', 'B'),
('Which planet is famous for its rings?', 'Mars', 'Jupiter', 'Saturn', 'Neptune', 'C'),
('What is the smallest planet in our solar system?', 'Mercury', 'Mars', 'Venus', 'Pluto', 'A'),
('What is the term for a star that has exploded?', 'Nova', 'Supernova', 'Quasar', 'Black Hole', 'B'),
('Which planet has the most moons?', 'Earth', 'Saturn', 'Jupiter', 'Neptune', 'C'),
('What is the name of the spacecraft that landed humans on the Moon?', 'Apollo 11', 'Voyager 1', 'Hubble', 'Challenger', 'A'),
('What is the name of the largest asteroid in the asteroid belt?', 'Ceres', 'Vesta', 'Pallas', 'Hygiea', 'A'),
('What is the name of the brightest star in the night sky?', 'Sirius', 'Vega', 'Betelgeuse', 'Rigel', 'A'),
('Which planet is known as Earth’s twin?', 'Venus', 'Mars', 'Mercury', 'Saturn', 'A'),
('What is the name of the first artificial satellite launched into space?', 'Explorer 1', 'Sputnik 1', 'Voyager 1', 'Luna 2', 'B'),
('What is the name of the galaxy closest to the Milky Way?', 'Triangulum Galaxy', 'Sombrero Galaxy', 'Andromeda Galaxy', 'Whirlpool Galaxy', 'C'),
('Which planet has a storm known as the Great Red Spot?', 'Mars', 'Saturn', 'Jupiter', 'Neptune', 'C'),
('What is the approximate age of the Earth?', '4.5 million years', '4.5 billion years', '13.8 billion years', '10 billion years', 'B'),
('What are the icy bodies that have tails and orbit the Sun called?', 'Asteroids', 'Comets', 'Meteoroids', 'Planetoids', 'B'),
('What is the name of the boundary around a black hole from which nothing can escape?', 'Event Horizon', 'Singularity', 'Quasar', 'Nebula', 'A'),
('What planet is tilted on its side, making it unique in the solar system?', 'Uranus', 'Neptune', 'Jupiter', 'Saturn', 'A'),
('What is the name of the telescope launched into space to observe distant galaxies?', 'James Webb Telescope', 'Kepler Telescope', 'Hubble Space Telescope', 'Chandra Observatory', 'C'),
('What type of galaxy is the Milky Way?', 'Elliptical', 'Spiral', 'Irregular', 'Lenticular', 'B'),
('What is the term for a planet outside our solar system?', 'Exoplanet', 'Dwarf Planet', 'Gas Giant', 'Terrestrial Planet', 'A'),
('Which planet has the highest mountain in the solar system?', 'Earth', 'Mars', 'Venus', 'Mercury', 'B'),
('What is the most abundant element in the universe?', 'Oxygen', 'Carbon', 'Hydrogen', 'Helium', 'C'),
('What is the shape of the Earth’s orbit around the Sun?', 'Circular', 'Elliptical', 'Parabolic', 'Hyperbolic', 'B'),
('Which planet has the fastest winds in the solar system?', 'Earth', 'Jupiter', 'Neptune', 'Saturn', 'C'),
('What is the name of the dwarf planet located in the Kuiper Belt?', 'Pluto', 'Eris', 'Ceres', 'Makemake', 'A'),
('What is the main component of the Sun?', 'Oxygen', 'Nitrogen', 'Hydrogen', 'Helium', 'C'),
('What is the second planet from the Sun?', 'Mercury', 'Venus', 'Earth', 'Mars', 'B'),
('What is the name of the spacecraft that explored Pluto?', 'Voyager 1', 'New Horizons', 'Pioneer 10', 'Cassini', 'B'),
('What is a shooting star?', 'Comet', 'Asteroid', 'Meteor', 'Planet', 'C'),
('Which planet has the shortest day?', 'Earth', 'Jupiter', 'Mars', 'Saturn', 'B'),
('What is the name of the largest volcano in the solar system?', 'Olympus Mons', 'Mount Everest', 'Mauna Kea', 'Mons Huygens', 'A'),
('What causes the seasons on Earth?', 'Distance from the Sun', 'Tilt of Earth’s axis', 'Earth’s rotation', 'Sunspot activity', 'B'),
('What is the coldest planet in our solar system?', 'Uranus', 'Neptune', 'Pluto', 'Saturn', 'A'),
('Which planet has a moon called Titan?', 'Mars', 'Saturn', 'Neptune', 'Jupiter', 'B'),
('What is the name of the first American astronaut to orbit Earth?', 'Neil Armstrong', 'John Glenn', 'Alan Shepard', 'Buzz Aldrin', 'B'),
('What is the name of the dark, flat areas on the Moon?', 'Craters', 'Maria', 'Highlands', 'Regolith', 'B'),
('What is the distance light travels in one year called?', 'Astronomical Unit', 'Parsec', 'Light-year', 'Kilometer', 'C'),
('What is the term for the explosion of a dying massive star?', 'Nova', 'Supernova', 'Quasar', 'Pulsar', 'B'),
('What is the smallest type of star?', 'Neutron Star', 'White Dwarf', 'Red Dwarf', 'Protostar', 'A'),
('What is the name of the spacecraft currently exploring Mars?', 'Curiosity', 'Opportunity', 'Perseverance', 'Spirit', 'C'),
('What is the approximate temperature at the surface of the Sun?', '5,500°C', '10,000°C', '2,000°C', '7,000°C', 'A'),
('What is the name of the spacecraft that sent back images of Saturn’s rings?', 'Voyager 2', 'Cassini', 'Pioneer 11', 'Hubble', 'B'),
('What is the closest planet to the Sun?', 'Mercury', 'Venus', 'Earth', 'Mars', 'A'),
('What is the brightest planet in the night sky?', 'Mars', 'Jupiter', 'Venus', 'Saturn', 'C'),
('What is the name of the belt of comets surrounding the solar system?', 'Kuiper Belt', 'Asteroid Belt', 'Oort Cloud', 'Heliosphere', 'C'),
('What is the name of the Moon’s largest crater?', 'Copernicus', 'Tycho', 'South Pole-Aitken Basin', 'Mare Imbrium', 'C');



select * from questions;
select * from students;
select * from admins;
