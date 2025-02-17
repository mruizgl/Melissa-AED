package es.ies.puerto.mr.tresenraya.infrastructure.adapters.secondary;

import jakarta.persistence.*;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

@Entity
@Table(name = "games")
@Data
@NoArgsConstructor
@AllArgsConstructor
public class GameEntity {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne
    @JoinColumn(name = "player1_id", nullable = false)
    private UserEntity player1;

    @ManyToOne
    @JoinColumn(name = "player2_id")
    private UserEntity player2;

    private String status;

    @Column(columnDefinition = "TEXT")
    private String boardState;
}
