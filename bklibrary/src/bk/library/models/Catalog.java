package bk.library.models;

import java.util.List;

/**
 * Catalog class represents book catalog.
 */
public class Catalog {
	
	private long id;
	private String title;
	private String callnumber;
	private String dewnumber;
	private String pubyear;
	private String edition;
	private String category;	
	private List<Author> authors;
	private List<CatalogCopy> catalogCopies;
	
	public long getId() {
		return id;
	}

	public void setId( long id ) {
		this.id = id;
	}

	public String getTitle() {
		return title;
	}

	public void setTitle( String title ) {
		this.title = title;
	}

	public String getCallnumber() {
		return callnumber;
	}

	public void setCallnumber( String callnumber ) {
		this.callnumber = callnumber;
	}

	public String getDewnumber() {
		return dewnumber;
	}

	public void setDewnumber( String dewnumber ) {
		this.dewnumber = dewnumber;
	}

	public String getPubyear() {
		return pubyear;
	}

	public void setPubyear( String pubyear ) {
		this.pubyear = pubyear;
	}

	public String getCategory() {
		return category;
	}

	public void setCategory( String category ) {
		this.category = category;
	}

	public List<Author> getAuthors() {
		return authors;
	}

	public void setAuthors( List<Author> authors ) {
		this.authors = authors;
	}
	
	public List<CatalogCopy> getCatalogCopies() {
		return catalogCopies;
	}

	public void setCatalogCopies( List<CatalogCopy> catalogCopies ) {
		this.catalogCopies = catalogCopies;
	}

	public String getEdition() {
		return edition;
	}

	public void setEdition( String edition ) {
		this.edition = edition;
	}
	
	
}
