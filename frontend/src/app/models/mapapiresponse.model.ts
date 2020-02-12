
export class MapAPIResponse {

  public name: string;
  public title: string;
  public results: any[];
  
  constructor(name: string, title: string, results: any[]) {
    this.name = name;
    this.title = title;
    this.results = results;
  }

}
