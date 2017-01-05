DROP TABLE IF EXISTS `cuidadores_users`;
CREATE TABLE `cuidadores_users` (
	`email` varchar(254) NOT NULL,
	`id_site` int(11) DEFAULT NULL,
	`id_community` int(11) DEFAULT NULL,
	`birthday` date DEFAULT NULL,
	`admin_notified` tinyint(1) NOT NULL DEFAULT '0',
	`name` text,
	`associate_nr` text,
	`activate_token` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `cuidadores_users` (`email`, `id_site`, `id_community`, `name`, `activate_token`) VALUES
	('admin@cuidadores.tk', 1, 1, 'Administrador', '');

ALTER TABLE `cuidadores_users`
	ADD PRIMARY KEY (`email`);

DELIMITER $$

DROP TRIGGER IF EXISTS BeforeCommunityUsersUpdate$$
CREATE TRIGGER BeforeCommunityUsersUpdate
BEFORE UPDATE ON community_users
FOR EACH ROW
BEGIN
	IF @trigger_updating IS NULL THEN
		SET @trigger_updating = 1;

		UPDATE users_field_data
		SET name = NEW.email, pass = NEW.password, mail = NEW.email
		WHERE uid IN (SELECT id_site FROM cuidadores_users WHERE id_community = NEW.id);

		UPDATE cuidadores_users
		SET email = NEW.email
		WHERE id_community = NEW.id;

		SET @trigger_updating = NULL;
	END IF;
END$$

DROP TRIGGER IF EXISTS BeforeUserFieldDataUpdate$$
CREATE TRIGGER BeforeUserFieldDataUpdate
BEFORE UPDATE ON users_field_data
FOR EACH ROW
BEGIN
	IF @trigger_updating IS NULL THEN
		SET @trigger_updating = 1;

		UPDATE community_users
		SET email = NEW.mail, password = NEW.pass
		WHERE id IN (SELECT id_community FROM cuidadores_users WHERE id_site = NEW.uid);

		SET NEW.name = NEW.mail;

		UPDATE cuidadores_users
		SET email = NEW.mail
		WHERE id_site = NEW.uid;

		SET @trigger_updating = NULL;
	END IF;
END$$

DROP TRIGGER IF EXISTS AfterCommunityUsersUpdate$$
CREATE TRIGGER AfterCommunityUsersUpdate
AFTER UPDATE ON community_users
FOR EACH ROW
BEGIN
	SET @trigger_updating = NULL;
END$$

DROP TRIGGER IF EXISTS AfterUserFieldDataUpdate;
CREATE TRIGGER AfterUserFieldDataUpdate
AFTER UPDATE ON users_field_data
FOR EACH ROW
BEGIN
	SET @trigger_updating = NULL;
END$$

DELIMITER ;
