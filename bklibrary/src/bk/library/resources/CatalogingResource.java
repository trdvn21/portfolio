package bk.library.resources;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.Context;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;
import javax.ws.rs.core.UriInfo;

/**
 * CatalogingService interface defines API for cataloging services:
 * - search catalogs/books
 * - add/remove/update catalogs/books
 */
@Path("/cataloging")
public interface CatalogingResource {

	/**
	 * This method returns catalogs matching search criteria.
	 * 
	 * @param uri HTTP request URI information
	 * @return The list of catalogs in JSON.
	 */
	@Path("/searchCatalogs")
	@GET
	@Produces(MediaType.APPLICATION_JSON)
	public Response searchCatalogs(@Context UriInfo uri);
	
}
