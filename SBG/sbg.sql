/*
Navicat MySQL Data Transfer

Source Server         : AAA-Server
Source Server Version : 50716
Source Host           : 192.168.65.2:3306
Source Database       : sbg

Target Server Type    : MYSQL
Target Server Version : 50716
File Encoding         : 65001

Date: 2016-12-27 16:38:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`usuario`  varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`tipo`  varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`arquivos_afetados`  varchar(2000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`ip_origem`  varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`data_hora`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
AUTO_INCREMENT=1

;

-- ----------------------------
-- Records of log
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`usuario`  varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`senha`  varbinary(20) NOT NULL ,
`nome`  varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`email`  varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
`cpf`  varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`departamento`  varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`flag_ativo_inativo`  bit(1) NOT NULL DEFAULT b'1' ,
`flag_primeiro_acesso`  bit(1) NOT NULL DEFAULT b'1' ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
AUTO_INCREMENT=12

;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
BEGIN;
INSERT INTO `usuarios` VALUES ('1', 'murilo.komirchuk', 0x0BC63B84EEFA90B3EABB37E7DC350A55, 'Murilo Nata Komirchuk de Jesus', 'ti.telecom@grupoportinho.com.br', '02658894309', 'TI', '', '\0'), ('2', 'abigail.moraes', 0x3141AD6119E59B3345B399B35F536931, 'Abigail Paula de Moraes', 'ouvidoria@grupoportinho.com.br', '0', 'SAC', '', '\0'), ('3', 'alison.hernandes', 0xFE3031215A32151EA6AE886F3F8C4727, 'Alison Hernandes', 'monitoria@grupoportinho.com.br', '0', 'Monitoria', '', '\0'), ('4', 'camila.pereira', 0xE9E211D22669538E49AD5B8D82BF7176, 'Camila Pereira', 'monitoria@grupoportinho.com.br', '0', 'Monitoria', '', '\0'), ('5', 'carolina.donega', 0x0BC63B84EEFA90B3EABB37E7DC350A55, 'Carolina Donega', 'monitoria@grupoportinho.com.br', '0', 'Monitoria', '', ''), ('6', 'clarice.laurino', 0xCCA296FBEA9C47A3B65BC22FB5466585, 'Clarice Laurino', 'ouvidoria@grupoportinho.com.br', '0', 'SAC', '', '\0'), ('7', 'elida.oliveira', 0x457EDE4F0BB8F22750D0BE71DC4CE353, 'Elida Oliveira', 'ouvidoria@grupoportinho.com.br', '0', 'SAC', '', '\0'), ('8', 'fernanda.pintor', 0x0BC63B84EEFA90B3EABB37E7DC350A55, 'Fernanda Pintor', 'fernanda.pintor@grupoportinho.com.br', '0', 'Supervisao', '', ''), ('9', 'franciele.oliveira', 0x5CD92FE7DB1AC2ADCDB8BF649CEDBE96, 'Franciele Oliveira', 'monitoria@grupoportinho.com.br', '0', 'Monitoria', '', '\0'), ('10', 'rafael.silva', 0x0BC63B84EEFA90B3EABB37E7DC350A55, 'Rafael Silva', 'ti.telecom@grupoportinho.com.br', '0', 'TI', '', ''), ('11', 'viviane.silva', 0xC76424A9B2E4BC0B8D718D875C73EA8C, 'Viviane Silva', 'monitoria@grupoportinho.com.br', '0', 'Monitoria', '', '\0');
COMMIT;

-- ----------------------------
-- Auto increment value for log
-- ----------------------------
ALTER TABLE `log` AUTO_INCREMENT=1;

-- ----------------------------
-- Auto increment value for usuarios
-- ----------------------------
ALTER TABLE `usuarios` AUTO_INCREMENT=12;
