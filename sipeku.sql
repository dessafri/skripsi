/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     7/3/2022 4:23:50 PM                          */
/*==============================================================*/


drop table if exists INDIKATOR;

drop table if exists JAWABAN;

drop table if exists KATEGORI;

drop table if exists KRITERIA_PERAN;

drop table if exists PERAN;

drop table if exists PERTANYAAN;

drop table if exists SEKOLAH;

/*==============================================================*/
/* Table: INDIKATOR                                             */
/*==============================================================*/
create table INDIKATOR
(
   ID_INDIKATOR         int not null,
   NAMA_INDIKATOR       varchar(126),
   primary key (ID_INDIKATOR)
);

/*==============================================================*/
/* Table: JAWABAN                                               */
/*==============================================================*/
create table JAWABAN
(
   ID_JAWABAN           int not null,
   ID_PERTANYAAN        int,
   ID_SEKOLAH           int,
   JENIS_PERAN          varchar(12),
   JAWABAN              varchar(126),
   primary key (ID_JAWABAN)
);

/*==============================================================*/
/* Table: KATEGORI                                              */
/*==============================================================*/
create table KATEGORI
(
   ID_KATEGORI          int not null,
   NAMA_KATEGORI        varchar(126),
   primary key (ID_KATEGORI)
);

/*==============================================================*/
/* Table: KRITERIA_PERAN                                        */
/*==============================================================*/
create table KRITERIA_PERAN
(
   ID_KRITERIA_PERAN    int not null,
   ID_INDIKATOR         int,
   ID_PERAN             int,
   primary key (ID_KRITERIA_PERAN)
);

/*==============================================================*/
/* Table: PERAN                                                 */
/*==============================================================*/
create table PERAN
(
   ID_PERAN             int not null,
   NAMA_PERAN           varchar(126),
   primary key (ID_PERAN)
);

/*==============================================================*/
/* Table: PERTANYAAN                                            */
/*==============================================================*/
create table PERTANYAAN
(
   ID_PERTANYAAN        int not null,
   ID_KATEGORI          int,
   ID_INDIKATOR         int,
   NAMA_PERTANYAAN      varchar(126),
   primary key (ID_PERTANYAAN)
);

/*==============================================================*/
/* Table: SEKOLAH                                               */
/*==============================================================*/
create table SEKOLAH
(
   ID_SEKOLAH           int not null,
   NAMA_SEKOLAH         varchar(125),
   primary key (ID_SEKOLAH)
);

alter table JAWABAN add constraint FK_RELATIONSHIP_6 foreign key (ID_PERTANYAAN)
      references PERTANYAAN (ID_PERTANYAAN) on delete restrict on update restrict;

alter table JAWABAN add constraint FK_RELATIONSHIP_7 foreign key (ID_SEKOLAH)
      references SEKOLAH (ID_SEKOLAH) on delete restrict on update restrict;

alter table KRITERIA_PERAN add constraint FK_RELATIONSHIP_4 foreign key (ID_INDIKATOR)
      references INDIKATOR (ID_INDIKATOR) on delete restrict on update restrict;

alter table KRITERIA_PERAN add constraint FK_RELATIONSHIP_5 foreign key (ID_PERAN)
      references PERAN (ID_PERAN) on delete restrict on update restrict;

alter table PERTANYAAN add constraint FK_RELATIONSHIP_2 foreign key (ID_KATEGORI)
      references KATEGORI (ID_KATEGORI) on delete restrict on update restrict;

alter table PERTANYAAN add constraint FK_RELATIONSHIP_3 foreign key (ID_INDIKATOR)
      references INDIKATOR (ID_INDIKATOR) on delete restrict on update restrict;

