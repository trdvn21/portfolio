package bk.library.storage.impl;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.List;

import bk.library.models.Author;
import bk.library.models.Catalog;
import bk.library.models.CatalogCopy;
import bk.library.resources.impl.CatalogSearchParams;
import bk.library.storage.LibraryStorage;

import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.jdbc.core.simple.ParameterizedRowMapper;

/**
 * LibraryStorageMySQL class accesses library data from mySQL database.
 */
public class LibraryStorageMySQL implements LibraryStorage {
	
	public static final String COL_CATALOG_ID = "id";
	public static final String COL_CATALOG_TITLE = "title";
	public static final String COL_CATALOG_CALLNUMBER = "callnumber";
	public static final String COL_CATALOG_DEWNUMBER = "dewnumber";
	public static final String COL_CATALOG_PUBYEAR = "pubyear";
	public static final String COL_CATALOG_EDITION = "edition";
	public static final String COL_CATALOG_CATEGORY = "category";
	
	public static final String COL_AUTHOR_ID = "id";
	public static final String COL_AUTHOR_FIRSTNAME = "firstname";
	public static final String COL_AUTHOR_LASTNAME = "lastname";
	
	public static final String COL_CATALOGCOPY_LOCATION = "location";
	
	private JdbcTemplate jdbcTemplate;
	
	@Override
	public List<Catalog> searchCatalogs(CatalogSearchParams searchParams) 
			throws SQLException {
		
		String sQuery = CatalogSearchQuery.createQuery(searchParams);
		
		final List<Catalog> aCatalogs = jdbcTemplate.query(
				sQuery, new ParameterizedRowMapper<Catalog>() {
            @Override
            public Catalog mapRow(ResultSet resultSet, int i) throws SQLException {
                Catalog catalog = new Catalog();
            	
                catalog.setId(resultSet.getLong(COL_CATALOG_ID));
                catalog.setTitle(resultSet.getString(COL_CATALOG_TITLE));
                catalog.setCallnumber(resultSet.getString(COL_CATALOG_CALLNUMBER));
                catalog.setDewnumber(resultSet.getString(COL_CATALOG_DEWNUMBER));
                catalog.setPubyear(resultSet.getString(COL_CATALOG_PUBYEAR));
                catalog.setEdition(resultSet.getString(COL_CATALOG_EDITION));
                catalog.setCategory(resultSet.getString(COL_CATALOG_CATEGORY));
                
                catalog.setAuthors(getAuthorsFor(catalog.getId()));
                catalog.setCatalogCopies(getCatalogCopiesFor(catalog.getId()));
                
                return catalog;
            }
        });
		
		return aCatalogs;
	}

	/**
	 * Retrieve authors of a catalogId.
	 */
	private List<Author> getAuthorsFor(long catalogId) {
		
		final List<Author> aAuthors = jdbcTemplate.query(
				"SELECT a.id, a.firstname, a.lastname " 
				+ "FROM (author a join author_catalog ac on a.id = ac.author_id) "
				+ "WHERE ac.catalog_id = ?", 
				new ParameterizedRowMapper<Author>() {
            @Override
            public Author mapRow(ResultSet resultSet, int i) throws SQLException {
            	Author author = new Author();
            	
                author.setId(resultSet.getLong(COL_AUTHOR_ID));
                author.setFirstname(resultSet.getString(COL_AUTHOR_FIRSTNAME));
                author.setLastname(resultSet.getString(COL_AUTHOR_LASTNAME));
                
                return author;
            }
        }, catalogId);
		
		return aAuthors;
	}
	
	/**
	 * Retrieve copies of a catalogId.
	 */
	private List<CatalogCopy> getCatalogCopiesFor(long catalogId) {
		
		final List<CatalogCopy> aCopies = jdbcTemplate.query(
				"SELECT location " 
				+ "FROM catalogcopy "
				+ "WHERE catalog_id = ?", 
				new ParameterizedRowMapper<CatalogCopy>() {
            @Override
            public CatalogCopy mapRow(ResultSet resultSet, int i) throws SQLException {
            	CatalogCopy copy = new CatalogCopy();
                copy.setLocation(resultSet.getString(COL_CATALOGCOPY_LOCATION));
                return copy;
            }
        }, catalogId);
		
		return aCopies;
	}

	public void setJdbcTemplate(JdbcTemplate jdbcTemplate) {
		this.jdbcTemplate = jdbcTemplate;
	}
}
