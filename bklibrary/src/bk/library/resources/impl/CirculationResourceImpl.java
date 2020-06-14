package bk.library.resources.impl;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;

import bk.library.resources.CirculationResource;
import bk.library.storage.LibraryStorage;

import org.springframework.jdbc.core.JdbcTemplate;


@Path("/circulation")
public class CirculationResourceImpl implements CirculationResource {

	private LibraryStorage libraryStorage;
	
	@Override
	@Path("/notyet")
	@GET
	@Produces(MediaType.APPLICATION_JSON)
	public Response notyet() {
		return null;
	}
	
	public void setLibraryStorage(LibraryStorage libraryStorage) {
		this.libraryStorage = libraryStorage;
	}

}
