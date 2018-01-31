import React from 'react';
import Title from './Title';
import Price from './Price';
import Description from './Description';
import StyledItem from './StyledItem';
import Outer from './Outer';
import ButtonContainer from './ButtonContainer';
import Btn from './ButtonContainer/Btn';

class Item extends React.Component {
  render() {
    const item = this.props.item;

    return (
      <Outer className="col-xs-4">
        <StyledItem>
          <Title>{item.title}</Title>
          <Price>{item.price}</Price>
          <Description>{item.description}</Description>
          <ButtonContainer>
            <Btn type="submit">Add to cart</Btn>
          </ButtonContainer>
        </StyledItem>
      </Outer>
    );
  }
}

export default Item;
