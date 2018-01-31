import React from 'react';

import Container from './Container';
import Inner from './Inner';
import FilterInput from './FilterInput';

const Filtering = (props) => (
  <Container>
    <Inner>
      <FilterInput type="text" onChange={props.changePhrase} />
    </Inner>
  </Container>
);

export default Filtering;
