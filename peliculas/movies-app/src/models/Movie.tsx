export class Movie {
    id: string;
    titulo: string;
    direccion: string;
    actores: string;
    argumento: string;
    imagen: string;
  
    constructor(
      id: string,
      titulo: string,
      direccion: string,
      actores: string,
      argumento: string,
      imagen: string
    ) {
      this.id = id;
      this.titulo = titulo;
      this.direccion = direccion;
      this.actores = actores;
      this.argumento = argumento;
      this.imagen = imagen;
    }
  
    static fromJSON(data: any): Movie {
      return new Movie(
        data.id || '',
        data.titulo || '',
        data.direccion || '',
        data.actores || '',
        data.argumento || '',
        data.imagen || ''
      );
    }
  
    toJSON(): object {
      return {
        id: this.id,
        titulo: this.titulo,
        direccion: this.direccion,
        actores: this.actores,
        argumento: this.argumento,
        imagen: this.imagen,
      };
    }
  }
  