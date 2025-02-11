import { BaseEntity, Column, Entity, ManyToMany, ManyToOne, OneToMany, PrimaryColumn, PrimaryGeneratedColumn } from "typeorm";
import { Alumno } from "./Alumno";
import { Matricula } from "./Matricula";

@Entity('Asignatura')
export class Asignatura extends BaseEntity
{
    @PrimaryGeneratedColumn()
    id: number;

    @Column('text')
    nombre: number;
    
    @Column('text')
    curso: number;
    
    @ManyToMany(() => Matricula, (matricula) => matricula.asignaturas)
    matriculas: Matricula[];
}