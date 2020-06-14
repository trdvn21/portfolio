package bk.library.resources.impl;

import java.sql.SQLException;
import java.util.Iterator;
import java.util.List;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.Context;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.MultivaluedMap;
import javax.ws.rs.core.Response;
import javax.ws.rs.core.UriInfo;

import bk.library.models.Catalog;
import bk.library.resources.CatalogingResource;
import bk.library.storage.LibraryStorage;

@Path("/cataloging")
public class CatalogingResourceImpl implements CatalogingResource {
	
	private LibraryStorage libraryStorage;

	@Override
	@Path("/searchCatalogs")
	@GET
	@Produces(MediaType.APPLICATION_JSON)
	public Response searchCatalogs(@Context UriInfo uri) {
		
		MultivaluedMap<String, String> uriQueryParams = uri.getQueryParameters();
		CatalogSearchParams searchParams = 
				CatalogSearchParams.createParams(uriQueryParams);
		
		List<Catalog> aCatalogs;
		try {
			aCatalogs = libraryStorage.searchCatalogs(searchParams);
		} catch (SQLException e) {
			// exception handler: not yet
			e.printStackTrace();
			return Response.ok().entity("Database access errors.").build();
		}
		
		if (aCatalogs.isEmpty()) {
			return Response.ok().entity("0 books found.").build(); 
		}
		else return Response.ok().entity(aCatalogs).build();
	}
	
	public void setLibraryStorage(LibraryStorage libraryStorage) {
		this.libraryStorage = libraryStorage;
	}
	
}
