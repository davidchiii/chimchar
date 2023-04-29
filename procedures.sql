-- ________________________________________________________
-- |                                                      |
-- |                         Officers                     |
-- |______________________________________________________|
-- get officers
DELIMITER //
CREATE PROCEDURE GetOfficers()
BEGIN
    SELECT *
    FROM officer;
END //
DELIMITER ;

-- get officers by precinct
DELIMITER //
CREATE PROCEDURE GetOfficersByPrecinct()
BEGIN
    SELECT *
    FROM officer
    GROUP BY precinct;
END //
DELIMITER ;

-- delete officers
DELIMITER //
CREATE PROCEDURE DeleteOfficerByFullName(IN firstName VARCHAR(10),IN lastName VARCHAR(15))
BEGIN
    DELETE FROM officer
    WHERE first_name = firstName AND last_name = lastName;
END //

-- update officers
DELIMITER //
CREATE PROCEDURE UpdateOfficer(
    IN officerId int,
    IN lastName varchar(15),
    IN firstName varchar(10),
    IN precinct char(4),
    IN badge varchar(14),
    IN phoneNum char(10),
    IN statusVal char(1)
)
BEGIN
    UPDATE Officer
    SET last_name = lastName,
        first_name = firstName,
        precinct = precinct,
        badge = badge,
        phone_num = phoneNum,
        status_val = statusVal
    WHERE officer_id = officerId;
END //
DELIMITER ;

-- insert new officer
DELIMITER //

CREATE PROCEDURE add_officer(
    IN last_name VARCHAR(15),
    IN first_name VARCHAR(10),
    IN precinct CHAR(4),
    IN badge VARCHAR(14),
    IN phone_num CHAR(10),
    IN status_val CHAR(1)
)
BEGIN
    INSERT INTO Officer (last_name, first_name, precinct, badge, phone_num, status_val)
    VALUES (last_name, first_name, precinct, badge, phone_num, status_val);
END //

DELIMITER ;


-- ________________________________________________________
-- |                                                      |
-- |                        Criminals                     |
-- |______________________________________________________|


-- get criminals
DELIMITER //
CREATE PROCEDURE PrintAllCriminals()
BEGIN
    SELECT *
    FROM Criminals;
END //
DELIMITER ;

-- search criminal
DELIMITER //
CREATE PROCEDURE SearchCriminalByID(IN input_id INT)
BEGIN
    SELECT *
    FROM Criminals
    WHERE criminal_id = input_id;
END
DELIMITER ;

-- get all crime codes associated with criminal
DELIMITER //
CREATE PROCEDURE SelectCrimeCodesByCriminalID(IN input_id INT)
BEGIN
    SELECT crime.crime_code, crime_code.code_desc
    FROM crime_code
    INNER JOIN crime_charge
    ON crime_code.crime_code = crime.crime_code
    INNER JOIN crime
    ON crime.crime_id = crime.crime_id
    WHERE crime_code.criminal_id = input_id;
END //
DELIMITER ;

-- update criminal
DELIMITER //
CREATE PROCEDURE UpdateCriminal(
    IN input_id INT,
    IN input_last_name VARCHAR(15),
    IN input_first_name VARCHAR(10),
    IN input_street VARCHAR(30),
    IN input_city VARCHAR(20),
    IN input_state_in CHAR(2),
    IN input_zip CHAR(5),
    IN input_phone_nmbr CHAR(10),
    IN input_voff_status CHAR(1),
    IN input_probation_status CHAR(1)
)
BEGIN
    UPDATE Criminals
    SET 
        last_name = input_last_name,
        first_name = input_first_name,
        street = input_street,
        city = input_city,
        state_in = input_state_in,
        zip = input_zip,
        phone_nmbr = input_phone_nmbr,
        voff_status = input_voff_status,
        probation_status = input_probation_status
    WHERE
        criminal_id = input_id;
END //
DELIMITER ;

-- select statement
SELECT * FROM criminals WHERE voff_status = "N"; 

-- update data
UPDATE Officer SET first_name = 'David' WHERE officer_id = 5;

-- trigger
CREATE TRIGGER update_criminal_date_added
BEFORE INSERT ON Criminals
FOR EACH ROW
BEGIN
    SET NEW.date_added = CURRENT_DATE();
END
