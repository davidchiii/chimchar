CREATE TABLE Appeal (
    appeal_id int,
    crime_id int,
    appeal_filing_date date,
    appeal_hearing_date date,
    appeal_status varchar(8),
    PRIMARY KEY (appeal_id),
    FOREIGN KEY (crime_id) REFERENCES Crime(crime_id)
);

-- Table Probation Officer

CREATE TABLE Prob_officer (
    prob_id int,
    last_name varchar(15),
    first_name varchar(10),
    street varchar(30),
    city varchar(20),
    state_in char(2),
    zip char(5),
    phone_num char(10),
    email varchar(30),
    status_val char(1) NOT NULL,
    PRIMARY KEY (prob_id)
);

-- Table: Criminal DONE

CREATE TABLE Criminals (
    criminal_id int,
    last_name varchar(15),
    first_name varchar(10),
    street varchar(30),
    city varchar(20),
    state_in char(2),
    zip char(5),
    phone_nmbr char(10),
    voff_status char(1) DEFAULT 'N',
    probation_status char(1) DEFAULT 'N',
    PRIMARY KEY (criminal_id)
);


-- Table: Crime DONE

CREATE TABLE Crime (
    crime_id int,
    criminal_id int,
    classification varchar(8) DEFAULT 'U',
    date_charged date,
    appeal_status varchar(16)  NOT NULL,
    hearing_date date,
    appeal_cutoff_date date,

    -- arresting_officer[1..*] varchar(64),
    -- crime_codes[1..*] int ,
    -- fine_amount decimal(11,2),
    -- court_fee decimal(11,2),
    -- amount_paid decimal(11,2),
    -- payment_due_date date,
    -- charge_status varchar(64),


    PRIMARY KEY (crime_id),
    FOREIGN KEY (criminal_id) REFERENCES Criminals(criminal_id),
    CHECK (hearing_date > date_charged)
);

-- DONE
CREATE TABLE Alias (
    alias_id INT,
    criminal_id int,
    alias varchar(20)
    PRIMARY KEY (alias_id),
    FOREIGN KEY (criminal_id) REFERENCES Criminals(criminal_id)
);

-- DONE
CREATE TABLE Appeal (
    appeal_id int,
    crime_id int,
    appeal_filing_date date,
    appeal_hearing_date date,
    appeal_status varchar(8) DEFAULT "P",
    PRIMARY KEY (appeal_id),
    FOREIGN KEY (crime_id) REFERENCES Crime(crime_id)
);


-- Table: Officer

CREATE TABLE Officer (
    officer_id int,
    last_name varchar(15),
    first_name varchar(10),
    precinct char(4)  NOT NULL,
    badge varchar(14) UNIQUE,
    phone_num char(10),
    status_val char(1) DEFAULT 'P',
    PRIMARY KEY (officer_id)
);


-- Table: Sentencing

CREATE TABLE Sentences (
    sentencing_id int,
    criminal_id int,
    sentence_type char(1),
    prob_id int,
    start_date date,
    end_date date,
    num_violations int NOT NULL,

    PRIMARY KEY (sentencing_id),
    FOREIGN KEY (criminal_id) REFERENCES Criminals(criminal_id),
    FOREIGN KEY (prob_id) REFERENCES prob_officer(prob_id),
    CHECK (end_date>start_date)
);


CREATE TABLE crime_code (
    crime_code int,
    code_desc varchar(30) NOT NULL UNIQUE,

    PRIMARY KEY (crime_code)
);

CREATE TABLE crime_charge (
    charge_id int,
    crime_id int,
    crime_code int,
    charge_status char(2),
    fine_amount int,
    court_fee int,
    amount_paid int,
    due_date date,

    PRIMARY KEY (charge_id),
    FOREIGN KEY (crime_id) REFERENCES crime(crime_id),
    FOREIGN KEY (crime_code) REFERENCES crime_code(crime_code)
);
