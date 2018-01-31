import React from 'react';
import Item from './Item';

class ProductList extends React.Component {

  render() {
    return (
      <div className="row">
        {this.props.products.map((item) => <Item item={item} />)}
      </div>
    );
  }
};

export default ProductList;
