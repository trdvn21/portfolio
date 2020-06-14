package bk.library.service;

import com.yammer.dropwizard.config.Configuration;

public class BkLibServiceConfiguration extends Configuration {

	private String dbUrl;
	private String dbUsername;
	private String dbPassword;

	public String getDbUrl() {
		return dbUrl;
	}

	public String getDbUsername() {
		return dbUsername;
	}

	public String getDbPassword() {
		return dbPassword;
	}
	
}
