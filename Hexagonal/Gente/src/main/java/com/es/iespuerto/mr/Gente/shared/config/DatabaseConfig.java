package com.es.iespuerto.mr.Gente.shared.config;

import com.mongodb.client.MongoClient;
import com.mongodb.client.MongoClients;
import org.springframework.context.annotation.Bean;
import org.springframework.data.mongodb.core.MongoTemplate;
import org.springframework.data.mongodb.core.SimpleMongoClientDatabaseFactory;
import org.springframework.jdbc.datasource.DriverManagerDataSource;

import javax.sql.DataSource;

public class DatabaseConfig {

    public DataSource dataSourceTest() {
        DriverManagerDataSource dataSource = new DriverManagerDataSource();
        dataSource.setDriverClassName("org.h2.Driver");
        dataSource.setUrl("jdbc:h2:file:/tmp/gente;DB_CLOSE_DELAY=-1");
        dataSource.setUsername("sa");
        dataSource.setPassword("");
        return dataSource;
    }

    @Bean
    public MongoClient mongoClientProd() {
        return MongoClients.create("mongodb://localhost:27017");
    }

    @Bean(name= "mongoTemplate")
    public MongoTemplate mongoTemplateProd() {
        return new MongoTemplate(new SimpleMongoClientDatabaseFactory(mongoClientProd(), "personasgente"));
    }
}
