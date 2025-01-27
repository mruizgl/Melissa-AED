package es.iespuerto.instituto.service;

import java.util.List;

public interface IServiceGeneric<Entity, DTO, ID> {
    List<DTO> findAll();
    DTO findById(ID id);
    DTO save(Entity entity);
    boolean delete(ID id);
    boolean update(Entity entity);
}
