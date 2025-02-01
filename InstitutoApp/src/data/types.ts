export interface Usuario {
    dni: string;
    fechaCreacion: number;
    correo: string;
    emailVerifiedAt: string;
    nombre: string;
    password: string;
    rol: string;
    rememberToken: string;
    updatedAt: string;
    verificado: number;
  }
  
  export interface Matricula {
    id: number;
    year: number;
    asignaturas: Asignatura[];
  }
  
  export interface Asignatura {
    id: number;
    curso: string;
    nombre: string;
    
  }