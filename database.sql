-- Chris Olmedo
-- David Chang

-- Table: Appeal
CREATE TABLE Appeal (
    appeal_id int  NOT NULL,
    appeal_filing_date date  NOT NULL AUTO_INCREMENT,
    appeal_hearing_date date  NOT NULL,
    status varchar(64)  NOT NULL,
    CONSTRAINT Appeal_pk PRIMARY KEY (appeal_id)
);

-- Table: Crime
CREATE TABLE Crime (
    crime_id int  NOT NULL,
    classification varchar(64)  NOT NULL AUTO_INCREMENT,
    date_charged date  NOT NULL,
    appeal_status int  NOT NULL,
    hearing_date date  NOT NULL,
    appeal_cutoff_date date  NOT NULL,
    arresting_officer[1..*] varchar(64)  NOT NULL,
    crime_codes[1..*] int  NOT NULL,
    fine_amount decimal(11,2)  NOT NULL,
    court_fee decimal(11,2)  NOT NULL,
    amount_paid decimal(11,2)  NOT NULL,
    payment_due_date date  NOT NULL,
    charge_status varchar(64)  NOT NULL,
    CONSTRAINT Crime_pk PRIMARY KEY (crime_id)
);

-- Table: Crime_charge
CREATE TABLE Crime_charge (
    charge_id int  NOT NULL,
    Officer_badge_num int  NOT NULL,
    Crime_crime_id int  NOT NULL,
    CONSTRAINT Crime_charge_pk PRIMARY KEY (charge_id)
);

-- Table: Crimes_Commited
CREATE TABLE Crimes_Commited (
    commited_id int  NOT NULL,
    Crime_crime_id int  NOT NULL,
    Criminal_criminal_id int  NOT NULL,
    CONSTRAINT Crimes_Commited_pk PRIMARY KEY (commited_id)
);

-- Table: Criminal
CREATE TABLE Criminal (
    criminal_id int  NOT NULL,
    name varchar(64)  NOT NULL AUTO_INCREMENT,
    address int  NOT NULL,
    phone_nmbr int  NOT NULL,
    voff_status bit  NOT NULL,
    probation_status bit  NOT NULL,
    aliases varchar(64)  NOT NULL,
    UNIQUE INDEX shipmet_details_ak_1 (address),
    CONSTRAINT Criminal_pk PRIMARY KEY (criminal_id)
);

-- Table: Criminal_Verdict
CREATE TABLE Criminal_Verdict (
    verdict_id int  NOT NULL,
    Sentencing_sentencing_id int  NOT NULL,
    Criminal_criminal_id int  NOT NULL,
    CONSTRAINT Criminal_Verdict_pk PRIMARY KEY (verdict_id)
);

-- Table: Officer
CREATE TABLE Officer (
    name varchar(64)  NOT NULL AUTO_INCREMENT,
    precinct varchar(64)  NOT NULL,
    badge_num int  NOT NULL,
    phone_contact int  NOT NULL,
    status bit  NOT NULL,
    CONSTRAINT Officer_pk PRIMARY KEY (badge_num)
);

-- Table: Sentence_Appeals
CREATE TABLE Sentence_Appeals (
    s_appeal_id int  NOT NULL,
    Sentencing_sentencing_id int  NOT NULL,
    Appeal_appeal_id int  NOT NULL,
    number_of_appeals int  NOT NULL,
    CONSTRAINT Sentence_Appeals_pk PRIMARY KEY (s_appeal_id)
);

-- Table: Sentencing
CREATE TABLE Sentencing (
    sentencing_id int  NOT NULL,
    start_date date  NOT NULL AUTO_INCREMENT,
    end_date date  NOT NULL,
    num_violations int  NOT NULL,
    sentence_type varchar(64)  NOT NULL,
    CONSTRAINT Sentencing_pk PRIMARY KEY (sentencing_id)
);


CREATE TABLE Officers(
    crime_id int NOT NULL,
    arresting_officer int NOT NULL,
    CONSTRAINT Officers_pk PRIMARY KEY (crime_id, arresting_officer)
);

CREATE TABLE Charges(
    crime_id int NOT NULL,
    crime_codes int NOT NULL,
    CONSTRAINT Charges_pk PRIMARY KEY (crime_id, crime_codes)
);

-- End of file.

