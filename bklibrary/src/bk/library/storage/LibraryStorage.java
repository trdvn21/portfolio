package bk.library.storage;

import java.sql.SQLException;
import java.util.List;

import bk.library.models.Catalog;
import bk.library.resources.impl.CatalogSearchParams;

/**
 * LibraryStorage interface defines methods to access library data storage, e.g. mySQL.
 */
public interface LibraryStorage {

	/**
	 * This method looks up catalogs matching search criteria.
	 * 
	 * @param searchParams Search criteria
	 * @return List of catalogs matching search criteria. null is returned if database errors.
	 * 
	 * @throws SQLException
	 */
	List<Catalog> searchCatalogs(CatalogSearchParams searchParams) throws SQLException;

}
