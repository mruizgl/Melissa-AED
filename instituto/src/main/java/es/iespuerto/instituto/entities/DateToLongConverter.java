package es.iespuerto.instituto.entities;


import jakarta.persistence.AttributeConverter;

import java.util.Date;

/**
 * Convertidor de date a long
 */
public class DateToLongConverter implements AttributeConverter<Date, Long> {
    public static Date longToDate(Long aLong) {
        return (aLong == null) ? null : new Date(aLong);
    }

    @Override
    public Long convertToDatabaseColumn(Date attribute) {
        return (attribute == null) ? null : attribute.getTime();
    }

    @Override
    public Date convertToEntityAttribute(Long dbData) {
        return (dbData == null) ? null : new Date(dbData);
    }
}