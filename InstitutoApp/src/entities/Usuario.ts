import { BaseEntity, Column, Entity, ManyToMany, ManyToOne, OneToMany, PrimaryColumn, PrimaryGeneratedColumn } from "typeorm";
import { Alumno } from "./Alumno";

@Entity('Usuario')
export class Usuario extends BaseEntity
{
    @PrimaryGeneratedColumn()
    id: number;


    @Column('text')
    nombre : string;

    @Column('text')
    password : string;
    
    @Column('text')
    correo : string;
    

    @Column('text')
    rol : string;
    
    @Column('int')
    verificado: number;

    @Column('integer')
    fecha_creacion: number;

}