package es.ies.puerto.mr.tresenraya.domain.model;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Data
@NoArgsConstructor
@AllArgsConstructor
public class Game {
    private Long id;
    private User player1;
    private User player2;
    private String[][] boardState;
    private User winner;
    private String status;


    public Game(Long id, User player1, User player2, String status) {
        this.id = id;
        this.player1 = player1;
        this.player2 = player2;
        this.status = status;
        this.boardState = new String[3][3];
        this.winner = null;
    }

    public Game(Long id, User player1, User player2, String status, String[][] boardState) {
        this.id = id;
        this.player1 = player1;
        this.player2 = player2;
        this.status = status;
        this.boardState = boardState;
    }





    public boolean isValidMove(int row, int col) {
        return row >= 0 && row < 3 && col >= 0 && col < 3 && boardState[row][col] == null;
    }

    public void makeMove(int row, int col, String symbol) {
        if (isValidMove(row, col)) {
            boardState[row][col] = symbol;
        }
    }
}
