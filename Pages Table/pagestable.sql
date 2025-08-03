DROP TABLE IF EXISTS pages;

CREATE TABLE pages (
  id INT(11) NOT NULL AUTO_INCREMENT,
  subject_id INT(11),
  menu_name VARCHAR(255),
  position INT(3),
  visible TINYINT(1),
  content TEXT,
  PRIMARY KEY (id)
);

ALTER TABLE pages ADD INDEX fk_subject_id (subject_id);

INSERT INTO pages (subject_id, menu_name, position, visible, content) VALUES
(1, 'Globe Bank', 1, 1, 'Welcome to Globe Bank, your trusted partner in financial success.'),
(1, 'History', 2, 1, 'Globe Bank was founded in 1923 with a vision to revolutionize personal banking.'),
(1, 'Leadership', 3, 1, 'Our leadership team brings decades of experience to drive innovation and trust.'),
(1, 'Contact Us', 4, 1, 'Reach out to us anytime via phone, email, or visit one of our branches.'),
(2, 'Banking', 1, 1, 'Explore our full suite of personal and business banking services.'),
(2, 'Credit Cards', 2, 1, 'Choose from a range of credit cards with competitive rates and exclusive rewards.'),
(2, 'Mortgages', 3, 1, 'Discover flexible mortgage options to help you find your perfect home.'),
(3, 'Checking', 1, 1, 'Our checking accounts are simple, secure, and designed for your everyday needs.'),
(3, 'Loans', 2, 1, 'We offer personal, auto, and home loans at great rates with flexible terms.'),
(3, 'Merchant Services', 3, 1, 'Boost your business with our reliable merchant processing solutions.');
