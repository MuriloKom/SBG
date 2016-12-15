/*
Navicat MySQL Data Transfer

Source Server         : SBG
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : sbg

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-12-15 14:14:50
*/

SET FOREIGN_KEY_CHECKS=0;

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
INSERT INTO `usuarios` VALUES ('1', 'murilo.komirchuk', 0xCDD538F4A836AF46482F27E818DD1673, 'Murilo Nata Komirchuk de Jesus', 'ti.telecom@grupoportinho.com.br', '02658894309', 'TI', '', '\0');
INSERT INTO `usuarios` VALUES ('2', 'abigail.moraes', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Abigail Paula de Moraes', 'ouvidoria@grupoportinho.com.br', '0', 'SAC', '', '');
INSERT INTO `usuarios` VALUES ('3', 'alison.hernandes', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Alison Hernandes', 'monitoria@grupoportinho.com.br', '0', 'Monitoria', '', '');
INSERT INTO `usuarios` VALUES ('4', 'camila.pereira', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Camila Pereira', 'monitoria@grupoportinho.com.br', '0', 'Monitoria', '', '');
INSERT INTO `usuarios` VALUES ('5', 'carolina.donega', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Carolina Donega', 'monitoria@grupoportinho.com.br', '0', 'Monitoria', '', '');
INSERT INTO `usuarios` VALUES ('6', 'clarice.laurino', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Clarice Laurino', 'ouvidoria@grupoportinho.com.br', '0', 'SAC', '', '');
INSERT INTO `usuarios` VALUES ('7', 'elida.oliveira', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Elida Oliveira', 'ouvidoria@grupoportinho.com.br', '0', 'SAC', '', '');
INSERT INTO `usuarios` VALUES ('8', 'fernanda.pintor', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Fernanda Pintor', 'fernanda.pintor@grupoportinho.com.br', '0', 'Supervisao', '', '');
INSERT INTO `usuarios` VALUES ('9', 'franciele.oliveira', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Franciele Oliveira', 'monitoria@grupoportinho.com.br', '0', 'Monitoria', '', '');
INSERT INTO `usuarios` VALUES ('10', 'rafael.silva', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Rafael Silva', 'ti.telecom@grupoportinho.com.br', '0', 'TI', '', '');
INSERT INTO `usuarios` VALUES ('11', 'viviana.martins', 0x54FD1C9C8B1EF4D63B63C1636FF7CB9B, 'Viviane Martins', 'monitoria@grupoportinho.com.br', '0', 'Monitoria', '', '');
COMMIT;

-- ----------------------------
-- Auto increment value for usuarios
-- ----------------------------
ALTER TABLE `usuarios` AUTO_INCREMENT=12;
