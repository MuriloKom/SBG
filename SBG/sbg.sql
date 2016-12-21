/*
Navicat MySQL Data Transfer

Source Server         : SBG
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : sbg

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-12-20 13:33:15
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
AUTO_INCREMENT=52

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
INSERT INTO `usuarios` VALUES ('1', 'murilo.komirchuk', 0x020A673CBE6B4896D7D544309BCF291E, 'Murilo Nata Komirchuk de Jesus', 'ti.telecom@grupoportinho.com.br', '02658894309', 'TI', '', '\0'), ('2', 'abigail.moraes', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Abigail Paula de Moraes', 'ouvidoria@grupoportinho.com.br', '0', 'SAC', '', ''), ('3', 'alison.hernandes', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Alison Hernandes', 'monitoria@grupoportinho.com.br', '0', 'Monitoria', '', ''), ('4', 'camila.pereira', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Camila Pereira', 'monitoria@grupoportinho.com.br', '0', 'Monitoria', '', ''), ('5', 'carolina.donega', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Carolina Donega', 'monitoria@grupoportinho.com.br', '0', 'Monitoria', '', ''), ('6', 'clarice.laurino', 0x020A673CBE6B4896D7D544309BCF291E, 'Clarice Laurino', 'ouvidoria@grupoportinho.com.br', '0', 'SAC', '', '\0'), ('7', 'elida.oliveira', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Elida Oliveira', 'ouvidoria@grupoportinho.com.br', '0', 'SAC', '', ''), ('8', 'fernanda.pintor', 0xBCF83E201A4891B9CAF02A6AB615888C, 'Fernanda Pintor', 'fernanda.pintor@grupoportinho.com.br', '0', 'Supervisao', '', '\0'), ('9', 'franciele.oliveira', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Franciele Oliveira', 'monitoria@grupoportinho.com.br', '0', 'Monitoria', '', ''), ('10', 'rafael.silva', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Rafael Silva', 'ti.telecom@grupoportinho.com.br', '0', 'TI', '', ''), ('11', 'viviane.martins', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Viviane Martins', 'monitoria@grupoportinho.com.br', '0', 'Monitoria', '', '');
COMMIT;

-- ----------------------------
-- Auto increment value for log
-- ----------------------------
ALTER TABLE `log` AUTO_INCREMENT=52;

-- ----------------------------
-- Auto increment value for usuarios
-- ----------------------------
ALTER TABLE `usuarios` AUTO_INCREMENT=12;
