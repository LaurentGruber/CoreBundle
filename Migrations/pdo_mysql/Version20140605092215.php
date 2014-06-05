<?php

namespace Claroline\CoreBundle\Migrations\pdo_mysql;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2014/06/05 09:22:16
 */
class Version20140605092215 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE claro_activity_past_evaluation (
                id INT AUTO_INCREMENT NOT NULL, 
                user_id INT DEFAULT NULL, 
                activity_parameters_id INT DEFAULT NULL, 
                last_date DATETIME DEFAULT NULL, 
                evaluation_type VARCHAR(255) DEFAULT NULL, 
                evaluation_status VARCHAR(255) DEFAULT NULL, 
                duration INT DEFAULT NULL, 
                score VARCHAR(255) DEFAULT NULL, 
                score_num INT DEFAULT NULL, 
                score_min INT DEFAULT NULL, 
                score_max INT DEFAULT NULL, 
                evaluation_comment VARCHAR(255) DEFAULT NULL, 
                details LONGTEXT DEFAULT NULL COMMENT '(DC2Type:json_array)', 
                INDEX IDX_F1A76182A76ED395 (user_id), 
                INDEX IDX_F1A76182896F55DB (activity_parameters_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE claro_activity_rule_action (
                id INT AUTO_INCREMENT NOT NULL, 
                resource_type_id INT DEFAULT NULL, 
                log_action VARCHAR(255) NOT NULL, 
                rule_type VARCHAR(255) DEFAULT NULL, 
                INDEX IDX_C8835D2098EC6B7B (resource_type_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE claro_activity_evaluation (
                id INT AUTO_INCREMENT NOT NULL, 
                user_id INT DEFAULT NULL, 
                activity_parameters_id INT NOT NULL, 
                last_date DATETIME DEFAULT NULL, 
                evaluation_type VARCHAR(255) DEFAULT NULL, 
                evaluation_status VARCHAR(255) DEFAULT NULL, 
                duration INT DEFAULT NULL, 
                score VARCHAR(255) DEFAULT NULL, 
                score_num INT DEFAULT NULL, 
                score_min INT DEFAULT NULL, 
                score_max INT DEFAULT NULL, 
                evaluation_comment VARCHAR(255) DEFAULT NULL, 
                details LONGTEXT DEFAULT NULL COMMENT '(DC2Type:json_array)', 
                total_duration INT DEFAULT NULL, 
                attempts_count INT DEFAULT NULL, 
                INDEX IDX_F75EC869A76ED395 (user_id), 
                INDEX IDX_F75EC869896F55DB (activity_parameters_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE claro_activity_rule (
                id INT AUTO_INCREMENT NOT NULL, 
                activity_parameters_id INT NOT NULL, 
                resource_id INT DEFAULT NULL, 
                badge_id INT DEFAULT NULL, 
                occurrence SMALLINT NOT NULL, 
                action VARCHAR(255) NOT NULL, 
                result VARCHAR(255) DEFAULT NULL, 
                resultComparison SMALLINT DEFAULT NULL, 
                userType SMALLINT NOT NULL, 
                additional_datas VARCHAR(255) DEFAULT NULL, 
                INDEX IDX_6824A65E896F55DB (activity_parameters_id), 
                INDEX IDX_6824A65E89329D25 (resource_id), 
                INDEX IDX_6824A65EF7A2C2FC (badge_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE claro_activity_parameters (
                id INT AUTO_INCREMENT NOT NULL, 
                activity_id INT DEFAULT NULL, 
                max_duration INT DEFAULT NULL, 
                max_attempts INT DEFAULT NULL, 
                evaluation_type VARCHAR(255) DEFAULT NULL, 
                UNIQUE INDEX UNIQ_E2EE25E281C06096 (activity_id), 
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            CREATE TABLE claro_activity_secondary_resources (
                activity_parameters_id INT NOT NULL, 
                resource_node_id INT NOT NULL, 
                INDEX IDX_713242A7896F55DB (activity_parameters_id), 
                INDEX IDX_713242A71BAD783F (resource_node_id), 
                PRIMARY KEY(
                    activity_parameters_id, resource_node_id
                )
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB
        ");
        $this->addSql("
            ALTER TABLE claro_activity_past_evaluation 
            ADD CONSTRAINT FK_F1A76182A76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id) 
            ON DELETE SET NULL
        ");
        $this->addSql("
            ALTER TABLE claro_activity_past_evaluation 
            ADD CONSTRAINT FK_F1A76182896F55DB FOREIGN KEY (activity_parameters_id) 
            REFERENCES claro_activity_parameters (id) 
            ON DELETE SET NULL
        ");
        $this->addSql("
            ALTER TABLE claro_activity_rule_action 
            ADD CONSTRAINT FK_C8835D2098EC6B7B FOREIGN KEY (resource_type_id) 
            REFERENCES claro_resource_type (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_activity_evaluation 
            ADD CONSTRAINT FK_F75EC869A76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_activity_evaluation 
            ADD CONSTRAINT FK_F75EC869896F55DB FOREIGN KEY (activity_parameters_id) 
            REFERENCES claro_activity_parameters (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_activity_rule 
            ADD CONSTRAINT FK_6824A65E896F55DB FOREIGN KEY (activity_parameters_id) 
            REFERENCES claro_activity_parameters (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_activity_rule 
            ADD CONSTRAINT FK_6824A65E89329D25 FOREIGN KEY (resource_id) 
            REFERENCES claro_resource_node (id)
        ");
        $this->addSql("
            ALTER TABLE claro_activity_rule 
            ADD CONSTRAINT FK_6824A65EF7A2C2FC FOREIGN KEY (badge_id) 
            REFERENCES claro_badge (id)
        ");
        $this->addSql("
            ALTER TABLE claro_activity_parameters 
            ADD CONSTRAINT FK_E2EE25E281C06096 FOREIGN KEY (activity_id) 
            REFERENCES claro_activity (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_activity_secondary_resources 
            ADD CONSTRAINT FK_713242A7896F55DB FOREIGN KEY (activity_parameters_id) 
            REFERENCES claro_activity_parameters (id)
        ");
        $this->addSql("
            ALTER TABLE claro_activity_secondary_resources 
            ADD CONSTRAINT FK_713242A71BAD783F FOREIGN KEY (resource_node_id) 
            REFERENCES claro_resource_node (id)
        ");
        $this->addSql("
            ALTER TABLE claro_activity 
            ADD parameters_id INT DEFAULT NULL
        ");
        $this->addSql("
            ALTER TABLE claro_activity 
            ADD CONSTRAINT FK_E4A67CAC88BD9C1F FOREIGN KEY (parameters_id) 
            REFERENCES claro_activity_parameters (id) 
            ON DELETE SET NULL
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_E4A67CAC88BD9C1F ON claro_activity (parameters_id)
        ");
        $this->addSql("
            ALTER TABLE claro_badge_rule 
            ADD additional_datas VARCHAR(255) DEFAULT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE claro_activity 
            DROP FOREIGN KEY FK_E4A67CAC88BD9C1F
        ");
        $this->addSql("
            ALTER TABLE claro_activity_past_evaluation 
            DROP FOREIGN KEY FK_F1A76182896F55DB
        ");
        $this->addSql("
            ALTER TABLE claro_activity_evaluation 
            DROP FOREIGN KEY FK_F75EC869896F55DB
        ");
        $this->addSql("
            ALTER TABLE claro_activity_rule 
            DROP FOREIGN KEY FK_6824A65E896F55DB
        ");
        $this->addSql("
            ALTER TABLE claro_activity_secondary_resources 
            DROP FOREIGN KEY FK_713242A7896F55DB
        ");
        $this->addSql("
            DROP TABLE claro_activity_past_evaluation
        ");
        $this->addSql("
            DROP TABLE claro_activity_rule_action
        ");
        $this->addSql("
            DROP TABLE claro_activity_evaluation
        ");
        $this->addSql("
            DROP TABLE claro_activity_rule
        ");
        $this->addSql("
            DROP TABLE claro_activity_parameters
        ");
        $this->addSql("
            DROP TABLE claro_activity_secondary_resources
        ");
        $this->addSql("
            DROP INDEX UNIQ_E4A67CAC88BD9C1F ON claro_activity
        ");
        $this->addSql("
            ALTER TABLE claro_activity 
            DROP parameters_id
        ");
        $this->addSql("
            ALTER TABLE claro_badge_rule 
            DROP additional_datas
        ");
    }
}