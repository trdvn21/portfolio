package bk.library.resources.impl;

import java.util.List;

import javax.ws.rs.core.MultivaluedMap;

/**
 * CatalogSearchParams class parses search criteria encapsulated in http request parameters.
 */
public class CatalogSearchParams extends HttpRequestParameters {

	public static final String URI_QUERY_PARAM_TITLE = "title";
	private String title;
	// and more ...
	
	/**
	 * A simple factory method.
	 */
	public static CatalogSearchParams createParams(
			MultivaluedMap<String, String> uriQueryParams) {
		
		CatalogSearchParams params = new CatalogSearchParams();
		List<String> aTitles = uriQueryParams.get(URI_QUERY_PARAM_TITLE);
		if (aTitles.size() > 0) {
			params.setTitle(aTitles.get(0)); 
		}
		
		return params;
	}

	public String getTitle() {
		return title;
	}

	public void setTitle(String title) {
		this.title = title;
	}
	
}
