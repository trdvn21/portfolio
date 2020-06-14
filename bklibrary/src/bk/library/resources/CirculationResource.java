package bk.library.resources;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;

/**
 * CirculationService interface defines API for circulation services:
 * - checkin/checkout
 * - add/remove users
 */
@Path("/circulation")
public interface CirculationResource {
	
	@Path("/notyet")
	@GET
	@Produces(MediaType.TEXT_PLAIN)
	public Response notyet();
	
}
