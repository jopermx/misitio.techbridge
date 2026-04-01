-- TechBridge Consulting Systems
-- Schema: tbcs

CREATE DATABASE IF NOT EXISTS tbcs
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE tbcs;

CREATE TABLE IF NOT EXISTS leads (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  status ENUM('new','contacted','qualified','discarded') NOT NULL DEFAULT 'new',
  form_type VARCHAR(40) NOT NULL DEFAULT 'contact_lead',
  source_page VARCHAR(120) DEFAULT NULL,
  source_campaign VARCHAR(80) DEFAULT NULL,
  full_name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  company VARCHAR(140) NOT NULL,
  employee_range VARCHAR(40) DEFAULT NULL,
  service_interest VARCHAR(500) DEFAULT NULL,
  challenge TEXT,
  notes TEXT,
  raw_payload JSON DEFAULT NULL,
  ip_hash CHAR(64) DEFAULT NULL,
  user_agent VARCHAR(500) DEFAULT NULL,
  PRIMARY KEY (id),
  KEY idx_status_created (status, created_at),
  KEY idx_email (email),
  KEY idx_phone (phone),
  KEY idx_form_type (form_type),
  KEY idx_source_page (source_page)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
