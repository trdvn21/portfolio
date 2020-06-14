package bk.library.service;

import bk.library.resources.impl.CatalogingResourceImpl;
import bk.library.resources.impl.CirculationResourceImpl;
import bk.library.storage.impl.LibraryStorageMySQL;

import org.apache.commons.dbcp.BasicDataSource;
import org.springframework.jdbc.core.JdbcTemplate;


import com.yammer.dropwizard.Service;
import com.yammer.dropwizard.config.Environment;

public class BkLibService extends Service<BkLibServiceConfiguration> {

	public static void main(String[] args) throws Exception {
        new BkLibService().run(args);
    }

    private BkLibService() {
        super("BK Library");
    }

    @Override
    protected void initialize(BkLibServiceConfiguration configuration,
                              Environment environment) {
    	
    	// load configuration
    	final String dbUrl = configuration.getDbUrl();
        final String dbUsername = configuration.getDbUsername();
        final String dbPassword = configuration.getDbPassword();
        
        // connect to database
        JdbcTemplate jdbcTemplate = getJdbcTempate(dbUrl, dbUsername, dbPassword);
        LibraryStorageMySQL libraryStorage = new LibraryStorageMySQL();
        libraryStorage.setJdbcTemplate(jdbcTemplate);
    	
        // add resources
        CatalogingResourceImpl cataRes = new CatalogingResourceImpl();
        cataRes.setLibraryStorage(libraryStorage);
    	environment.addResource(cataRes);
    	
    	CirculationResourceImpl cirRes = new CirculationResourceImpl();
    	cirRes.setLibraryStorage(libraryStorage);
    	environment.addResource(cirRes);
    }
    
    private JdbcTemplate getJdbcTempate(String dbUrl, String dbUsername, 
    		String dbPassword) {
    	
        final BasicDataSource dataSource = new BasicDataSource();
        dataSource.setDriverClassName("com.mysql.jdbc.Driver");
        dataSource.setUrl(dbUrl);
        dataSource.setUsername(dbUsername);
        dataSource.setPassword(dbPassword);

        final JdbcTemplate jdbcTemplate = new JdbcTemplate(dataSource);
        return jdbcTemplate;
    }
    
}
