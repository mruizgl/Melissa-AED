import { BaseEntity, Column, Entity, ManyToMany, ManyToOne, OneToMany, PrimaryColumn, PrimaryGeneratedColumn } from "typeorm";
import { Alumno } from "./Alumno";
import { Asignatura } from "./Asignatura";

@Entity('Matricula')
export class Matricula extends BaseEntity
{
    @PrimaryGeneratedColumn()
    id: number;

    @Column('int')
    year: number;
    
    @ManyToOne(() => Alumno, (alumno) => alumno.matriculas)
    alumno: Alumno;

    @ManyToMany(() => Asignatura, (asignatura) => asignatura.matriculas)
    asignaturas: Asignatura[];

}