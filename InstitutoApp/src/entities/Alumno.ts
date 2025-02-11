import { BaseEntity, Column, Entity, ManyToMany, OneToMany, PrimaryColumn, PrimaryGeneratedColumn } from "typeorm";
import { Matricula } from "./Matricula";

@Entity('alumno')
export class Alumno extends BaseEntity
{
    @PrimaryColumn('text')
    dni: string;

    @Column('text')
    nombre: string;

    @Column('text')
    apellidos: string;


    @Column('integer')
    fechanacimiento: number;

    @Column('text')
    path_foto: string;

    @OneToMany(() => Matricula, (matricula) => matricula.alumno)
    matriculas: Matricula[];
}