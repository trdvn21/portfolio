package bk.library.storage.impl;

import bk.library.resources.impl.CatalogSearchParams;
import bk.library.resources.impl.HttpRequestParameters;

/**
 * CatalogSearchQuery class prepares query, e.g. mySQL query, from http request parameters.
 */
public class CatalogSearchQuery {

	public static String createQuery(HttpRequestParameters httpReqParams) {
		CatalogSearchParams params = (CatalogSearchParams) httpReqParams;
		
		String sTitle = params.getTitle(); 
		String sQuery = "";
		if (sTitle != null) {
			// search titles that contain all words in any order, i.e. AND search
			String[] words = sTitle.split("\\s+");
			sQuery = "SELECT * FROM catalog"
					+ " WHERE title LIKE " + "'%" + words[0] + "%'";
			for (int i = 1; i < words.length; i++) {
				sQuery +=  " AND title LIKE " + "'%" + words[i] + "%'";
			}
		}
		
		return sQuery;
	}
	
}
