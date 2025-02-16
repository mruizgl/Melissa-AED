package es.ies.puerto.mr.tresenraya.mapper;

import es.ies.puerto.mr.tresenraya.domain.model.User;
import es.ies.puerto.mr.tresenraya.infrastructure.adapters.secondary.UserEntity;

public class UserMapper {
    public static UserEntity toEntity(User user) {
        return new UserEntity(user.getId(), user.getEmail(), user.getPassword(), user.getUsername());
    }

    public static User toDomain(UserEntity userEntity) {
        return new User(userEntity.getId(), userEntity.getEmail(), userEntity.getPassword(), userEntity.getUsername());
    }
}