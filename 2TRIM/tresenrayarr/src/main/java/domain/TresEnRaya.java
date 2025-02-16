package domain;

import java.util.Scanner;

public class TresEnRaya {
    private static char[][] tablero = {
            {' ', ' ', ' '},
            {' ', ' ', ' '},
            {' ', ' ', ' '}
    };
    private static char turno = 'X';

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        boolean juegoActivo = true;

        System.out.println("¡Bienvenidos al Tres en Raya!");
        imprimirTablero();

        while (juegoActivo) {
            System.out.println("Turno del jugador " + (turno == 'X' ? "1 (X)" : "2 (O)"));
            System.out.print("Ingrese la fila (0, 1, 2): ");
            int fila = scanner.nextInt();
            System.out.print("Ingrese la columna (0, 1, 2): ");
            int columna = scanner.nextInt();

            if (movimientoValido(fila, columna)) {
                tablero[fila][columna] = turno;
                imprimirTablero();

                if (hayGanador()) {
                    System.out.println("¡Jugador " + (turno == 'X' ? "1 (X)" : "2 (O)") + " gana!");
                    juegoActivo = false;
                } else if (tableroLleno()) {
                    System.out.println("¡Empate! El tablero está lleno.");
                    juegoActivo = false;
                } else {
                    cambiarTurno();
                }
            } else {
                System.out.println("Movimiento inválido. Intente de nuevo.");
            }
        }

        scanner.close();
        System.out.println("Fin del juego. ¡Gracias por jugar!");
    }

    private static void imprimirTablero() {
        System.out.println("  0   1   2");
        for (int i = 0; i < 3; i++) {
            System.out.print(i + " ");
            for (int j = 0; j < 3; j++) {
                System.out.print(tablero[i][j]);
                if (j < 2) System.out.print(" | ");
            }
            System.out.println();
            if (i < 2) System.out.println(" ---+---+---");
        }
    }

    private static boolean movimientoValido(int fila, int columna) {
        return fila >= 0 && fila < 3 && columna >= 0 && columna < 3 && tablero[fila][columna] == ' ';
    }

    private static void cambiarTurno() {
        turno = (turno == 'X') ? 'O' : 'X';
    }

    private static boolean hayGanador() {
        return (tablero[0][0] == turno && tablero[0][1] == turno && tablero[0][2] == turno) ||
                (tablero[1][0] == turno && tablero[1][1] == turno && tablero[1][2] == turno) ||
                (tablero[2][0] == turno && tablero[2][1] == turno && tablero[2][2] == turno) ||
                (tablero[0][0] == turno && tablero[1][0] == turno && tablero[2][0] == turno) ||
                (tablero[0][1] == turno && tablero[1][1] == turno && tablero[2][1] == turno) ||
                (tablero[0][2] == turno && tablero[1][2] == turno && tablero[2][2] == turno) ||
                (tablero[0][0] == turno && tablero[1][1] == turno && tablero[2][2] == turno) ||
                (tablero[0][2] == turno && tablero[1][1] == turno && tablero[2][0] == turno);
    }

    private static boolean tableroLleno() {
        for (int i = 0; i < 3; i++) {
            for (int j = 0; j < 3; j++) {
                if (tablero[i][j] == ' ') {
                    return false;
                }
            }
        }
        return true;
    }
}
