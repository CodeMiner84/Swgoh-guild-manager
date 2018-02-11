import React from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import { createSelector } from 'reselect';
import actions from '../../actions/search';
import ProductList from './ProductList';

class Dashboard extends React.Component {
  constructor(props) {
    super(props);
    this.props.getAll();
  }

  changePhrase = (phrase) => {
    this.props.getAll(phrase);
  }

  render() {
    return (
      <div >
        <ProductList
          products={this.props.products}
          changePhrase={this.changePhrase}
        />
      </div>
    );
  }
}


Dashboard.propTypes = {
  getAll: PropTypes.func.isRequired,
};

const geDashboardProducts = state => state.search.products;

const selector = createSelector(
  geDashboardProducts,
  (products) => {
    return products;
  },
);

function mapStateToProps(state) {
  return {
    products: selector(state),
  };
}

const mapDispatchToProps = {
  getAll: actions.fetchProducts,
};

export default connect(mapStateToProps, mapDispatchToProps)(Dashboard);
