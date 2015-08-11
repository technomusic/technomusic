<?php
try 
    {
    $dbh = new PDO('sqlite:./data/movies.db');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Création de la table movies
    $dbh->exec("CREATE TABLE movies (id INTEGER PRIMARY KEY, title VARCHAR(255), director VARCHAR(255), description TEXT, year INTEGER, rating INTEGER, image VARCHAR(255), url VARCHAR(255))");
 
    // Tableau de requêtes en INSERT
    $queries = array ("INSERT INTO movies (title, director, description, year, rating, image, url) VALUES ('Drive', 'Nicolas Winding Refn', 'A mysterious Hollywood stuntman, mechanic and getaway driver lands himself in trouble when he helps out his neighbour.', 2011, 8, 'MV5BOTM1ODQ0Nzc4NF5BMl5BanBnXkFtZTcwMTM0MjQyNg@@._V1_SX320.jpg', 'http://www.imdb.com/title/tt0780504/')",
                      "INSERT INTO movies (title, director, description, year, rating, image, url) VALUES ('Inception', 'Christopher Nolan', 'In a world where technology exists to enter the human mind through dream invasion, a highly skilled thief is given a final chance at redemption which involves executing his toughest job to date: Inception.', 2010, 8, 'MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_SX320.jpg', 'http://www.imdb.com/title/tt1375666/')",
                      "INSERT INTO movies (title, director, description, year, rating, image, url) VALUES ('Mystic River', 'Clint Eastwood', 'With a childhood tragedy that overshadowed their lives, three men are reunited by circumstance when one loses a daughter', 2003, 8, 'MV5BMTIzNDUyMjA4MV5BMl5BanBnXkFtZTYwNDc4ODM3._V1_SX320.jpg', 'http://www.imdb.com/title/tt0327056/')",
                      "INSERT INTO movies (title, director, description, year, rating, image, url) VALUES ('The Girl with the Dragon Tattoo', 'Niels Arden Oplev', 'A journalist is aided in his search for a woman who has been missing -- or dead -- for forty years by a young female hacker.', 2009, 7, 'MV5BMTczNDk4NTQ0OV5BMl5BanBnXkFtZTcwNDAxMDgxNw@@._V1_SX320.jpg', 'http://www.imdb.com/title/tt1132620/')",
                      "INSERT INTO movies (title, director, description, year, rating, image, url) VALUES ('Eastern Promises', 'David Cronenberg', 'A Russian teenager living in London who dies during childbirth leaves clues to a midwife in her journal that could tie her child to a rape involving a violent Russian mob family.', 2007, 7, 'MV5BMTcwMzU0OTY3NF5BMl5BanBnXkFtZTYwNzkwNjg2._V1_SY667_SX450_.jpg', 'http://www.imdb.com/title/tt0765443/?ref_=tt_rec_tt')",
                      "INSERT INTO movies (title, director, description, year, rating, image, url) VALUES ('Gone Baby Gone', 'Ben Affleck', 'Two Boston area detectives investigate a little girls kidnapping, which ultimately turns into a crisis both professionally and personally. Based on the Dennis Lehane novel.', 2007, 7, 'MV5BMTcwMzU0OTY7GD5BMl5BanBnXkFtZTYwNzkwNjg2._V1_SY667_SX450_.jpg', 'http://www.imdb.com/title/tt0452623/?ref_=ttmi_tt')");

    // Boucle passant en revue les requêtes en INSERT
    foreach($queries as $query)
        {
        // Exécution de la reqête en INSERT
        // Insertion des données de tests dans la table movies
	    $dbh->exec($query);
	    }
	    
	echo "Données de test insérées dans la base de données movies.db";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
?>